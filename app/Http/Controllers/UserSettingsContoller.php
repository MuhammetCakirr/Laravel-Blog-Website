<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserSettingsContoller extends Controller
{


    public function getSettingsPage()
    {
        // dd(Auth::user()->fname.Auth::user()->lname.Auth::user()->email);
        return view('user_settings')->with([
            'fname' => Auth::user()->fname,
            'lname' => Auth::user()->lname,
            'email' => Auth::user()->email,
            'photo_url' => Auth::user()->photo_url,
        ]);
    }
    public function deleteUserForDb()
    {
        $userId = Auth::user()->id;
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        User::where('id', $userId)->delete();
        return redirect('login');
    }
    public function updateUserForDb(Request $request)
    {
        $userId = Auth::user()->id;
        $newfname = $request->setfname;
        $newlname = $request->setlname;
        $file = $request->file('validatedCustomFile');
        $currentpassword = $request->setcurrentpasw;
        $newpassword = $request->setnewpasw_confirmation;

        $dataToUpdate = [
            'fname' => $newfname,
            'lname' => $newlname,
        ];
        if ($file) {
            if ($file->getError() !== UPLOAD_ERR_OK) {
                return redirect()->back()->withErrors(['validatedCustomFile' => 'File upload error: ' . $file->getErrorMessage()]);
            }
            $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/uploads/user'), $fileName);
            $dataToUpdate['photo_url'] = $fileName;
        }
        if (!empty(trim($currentpassword)) && !empty(trim($newpassword))) {
            if (Hash::check($currentpassword, Auth::user()->password)) {
                $dataToUpdate['password'] = Hash::make($newpassword);
            } else {
                return redirect()->back()->withErrors(['setcurrentpasw' => 'Current password is incorrect.'])->withInput();
            }
        }
        User::where('id', $userId)->update($dataToUpdate);
        return redirect()->back()->with('success', 'Profile updated successfully.');

    }

    public function userPasswordCheckDb(Request $request)
    {
        // User::delete();
    }

    public function updateUserRole(){
        $user = User::find(5);
        $role = Role::findByName('Developer');
        $user->assignRole($role);
    }

    public function logoutFun()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return view('login');
    }

    public function userspage(){
        $users = User::with('roles')->orderBy('created_at','DESC')->get();
        return view('users', compact('users'));
    }

    public function userApproval(Request $request){
        $user_id=$request->userid;
        User::where("id",$user_id)->update(["is_approved"=>1]);
        $message="User account approved";
        return redirect()->intended('Users')->with([
          "message"=>$message
        ]);
    }

    public function editUserRole(Request $request){
        $user_id=$request->userid;
        $user = User::with('roles','posts')->where('id',$user_id)->get()->firstOrFail();
        $roles = Role::all();
        // dd($user);
        return view('edit_user_role', compact('user','roles'));
    }

    private $roleHierarchy = [
        'Ceo' => 1,
        'Manager' => 2,
        'Team Lead' => 3,
        'Developer' => 4
    ];
    public function editUserRoleDb(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::findOrFail($user_id);
        $loggedInUser = Auth::user();

        // Düzenleme yapan kullanıcının en yüksek rolünün hiyerarşi değeri
        $loggedInUserHighestRole = $this->getHighestRole($loggedInUser);

        // Düzenlenen kullanıcının en yüksek rolünün hiyerarşi değeri
        $targetUserHighestRole = $this->getHighestRole($user);

        // Düzenleme yapan kullanıcının rolü, hedef kullanıcının rolünden düşükse işlemi engelle
        if ($loggedInUserHighestRole > $targetUserHighestRole) {
            return redirect()->route('Users')->with('error', 'You do not have permission to edit this user\'s roles.');
        }

        $user->syncRoles($request->roles);
        return redirect()->route('Users')->with('message', 'User roles updated successfully');
    }

    private function getHighestRole($user)
    {
        $roles = $user->roles->pluck('name')->toArray();
        $highestRole = max(array_map(function($role) {
            return $this->roleHierarchy[$role];
        }, $roles));

        return $highestRole;
    }
}
