<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserSettingsCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $rules = [
            'setfname' => 'required|string|max:255|min:2',
            'setlname' => 'required|string|max:255|min:2',
            'validatedCustomFile' => 'file|image', 
        ];
    
        if ($request->filled('setcurrentpasw')) 
        {
            $oldPassword = Auth::user()->password;
            $rules['setcurrentpasw'] = [
                'required',
                'string',
                'min:8',
                function ($attribute, $value, $fail) use ($oldPassword, $request) 
                {
                    if (!\Hash::check($request->setcurrentpasw, $oldPassword)) {
                        return $fail(__('Current password is incorrect.'));
                    }
                    if (\Hash::check($request->setcurrentpasw, $request->setnewpasw_confirmation)) {
                        return $fail(__('The new password cannot be the same as the current password.'));
                    }
                }
            ];
            $rules['setnewpasw_confirmation'] = 'required|string|min:8';
        }
    
        $messages = [
            'setfname.required' => 'First name is required.',
            'setlname.required' => 'Last name is required.',
            'setfname.min' => 'First name must be at least 2 characters.',
            'setlname.min' => 'Last name must be at least 2 characters.',
            'setcurrentpasw.required' => 'Password is required.',
            'setcurrentpasw.min' => 'The password must be at least 8 characters.',
            'setcurrentpasw.same' => 'Password and confirmation must match.',
            'setnewpasw_confirmation.required' => 'Please enter a new your password.',
            'setnewpasw_confirmation.min' => 'New password must be at least 8 characters.',
            'validatedCustomFile.file' => 'The selected file must be a file.',
            'validatedCustomFile.image' => 'The selected file must be an image.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'UserUpdateErrors')->withInput();
        }
            return $next($request);
    }
    
    

}
