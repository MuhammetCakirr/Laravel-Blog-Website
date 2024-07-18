<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserCreateCheck
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
        if ($request->is('SignIn')) 
        {
            // Giriş formu için doğrulama kuralları
            $rules = [
                'siemail' => 'required|email',
                'sipasw' => 'required|min:8',
            ];

            $messages = [
                'siemail.required' => 'Email is required.',
                'siemail.email' => 'The email must be a valid email address.',
                'sipasw.required' => 'Password is required.',
                'sipasw.min' => 'The password must be at least 8 characters.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator, 'SignInErrors')->withInput();
            }
        }
        elseif ($request->is('SignUp'))
        {
            $rules = [
                'sofname' => 'required|string|max:255|min:2',
                'solname' => 'required|string|max:255|min:2',
                'soemail' => 'required|email|unique:users,email',
                'sopasw' => 'required|string|min:8|confirmed',
            ];
    
            $messages = [
                'sofname.required' => 'First name is required.',
                'solname.required' => 'Last name is required.',
                'soemail.required' => 'Email is required.',
                'soemail.email' => 'The email must be a valid email address.',
                'soemail.unique' => 'This email has already been taken.',
                'sopasw.required' => 'Password is required.',
                'sopasw.min' => 'The password must be at least 8 characters.',
                'sofname.min' => 'First name must be at least 2 characters.',
                'solname.min' => 'First name must be at least 2 characters.',
                'sopasw.confirmed' => 'The password confirmation does not match.',
            ];
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator, 'SignUpErrors')->withInput();
            }
        }
            return $next($request);
        
    }
}
