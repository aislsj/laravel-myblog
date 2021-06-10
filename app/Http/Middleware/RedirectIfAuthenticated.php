<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        var_dump(Auth::guard($guard)->check());exit;
        if (Auth::guard($guard)->check()) {
            switch (Auth::guard($guard)) {
                case 'web':
                    return redirect(RouteServiceProvider::HOME);
                case 'admin':
                    return redirect(RouteServiceProvider::ADMIN_HOME);
                case 'phone':
                    return redirect(RouteServiceProvider::PHONE_HOME);
            }
        }

        return $next($request);
    }
}
