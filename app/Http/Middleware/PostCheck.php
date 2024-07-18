<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostCheck
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
            'posttitle' => 'required|string|min:2',
            'postsubject' => 'required|string|min:2',
            'validatedCustomFile' => 'required|file|image', 
        ];

        $messages = [
            'posttitle.required' => 'Title is required.',
            'postsubject.required' => 'Content is required.',
            'posttitle.min' => 'Title must be at least 2 characters.',
            'postsubject.min' => 'Content must be at least 2 characters.',
            'validatedCustomFile.required' => 'Please select a photo.',
            'validatedCustomFile.file' => 'The selected file must be a file.',
            'validatedCustomFile.image' => 'The selected file must be an image.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator, 'PostAddErrors')->withInput();
        }
        return $next($request);
    }
}
