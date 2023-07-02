<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Check2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Session::has('user_2fa')){
            return redirect()->route('check2fa.index');
        }
        if($request->user()->estado!='ACTIVO'){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Session::flash('info','Su cuenta se encuentra inactiva.');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
