<?php

namespace App\Http\Middleware;
session_start();
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMiddleWare
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
        if (Auth::check()) {
            $_SESSION['use_ck'] = 1;
            $_SESSION['stage'] = config('app.env');
            return $next($request);
        } else {
            $_SESSION['use_ck'] = 0;
            return redirect()->route('login_panel');
        }
    }
}
