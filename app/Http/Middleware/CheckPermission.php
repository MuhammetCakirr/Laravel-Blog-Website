<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        // Kullanıcı yetki kontrolü
        if($request->is('EditPost')){
            if (!Auth::user()->can('edit post')) {
                return redirect()->back()->with(['unauthorized' => 'unauthorized']);
    
            }
        }
        else if($request->is('Users'))
        {
            if (!Auth::user()->can('view users')) {
                return redirect()->back()->with(['unauthorized' => 'unauthorized']);
    
            }
        }
        else if($request->is('PostApproval')){
            if (!Auth::user()->can('direct post creation')) {
                return redirect()->back()->with(['unauthorized' => 'unauthorized']);
    
            }
        }
        else if($request->is('UserApproval')){
            if (!Auth::user()->can('user account confirmation')) {
                return redirect()->back()->with(['unauthorized' => 'unauthorized']);
    
            }
        }
        else if($request->is('EditUserRole')){
            if (!Auth::user()->can('edit role')) {
                return redirect()->back()->with(['unauthorized' => 'unauthorized']);
    
            }
        }
        else if($request->is('PostCancel') || $request->is('PostDelete')){
            if (!Auth::user()->can('delete post')) {
                return redirect()->back()->with(['unauthorized' => 'unauthorized']);
    
            }
        }
        

        return $next($request);
    }
}
