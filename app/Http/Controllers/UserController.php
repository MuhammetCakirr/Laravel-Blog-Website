<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function signUpUserForDb(Request $request)
  {
    $fname = $request->sofname;
    $lname = $request->solname;
    $email = $request->soemail;
    $password = $request->sopasw;

    $hashedPassword = Hash::make($password);
    $user = User::create([
      "fname" => $fname,
      "lname" => $lname,
      "email" => $email,
      "password" => $hashedPassword,
      "is_approved"=>0
    ]);
    // Auth::login($user);
    // dd(Auth::user()->fname . Auth::user()->lname . Auth::user()->email);
    $message="Your account has been created. Waiting for the administrator's approval.";
    return redirect()->intended('Login')->with([
      "message"=>$message
    ]);
  }
  public function signInUser(Request $request)
{
    $credentials = [
        'email' => $request->siemail,
        'password' => $request->sipasw,
    ];

    $user = User::where('email', $request->siemail)->first();

    if ($user && $user->is_approved != 1) {
        return back()->withErrors([
            'email' => 'Your account has not been approved by the administrator yet.',
        ])->withInput($request->only('siemail'));
    }

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // HER OTURUM AÇMA SONRASI SESSİON'U GÜVENLİK AMACIYLA YENİLEMEK.
        return redirect()->intended('Settings')->with([
            'fname' => Auth::user()->fname,
            'lname' => Auth::user()->lname,
            'email' => Auth::user()->email,
            'photo_url'=>Auth::user()->photo_url,
        ]);
    } else {
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('siemail'));
    }
}

  public function isExistingEmailCheckDb(Request $request)
  {
    // User::delete();
  }



}
