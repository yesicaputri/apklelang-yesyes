<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->level == 'admin')
                return redirect()->route('admin.dashboard');
                else if(Auth::user()->level == 'petugas')
                return redirect()->route('petugas.dashboard');
                else if(Auth::user()->level == 'masyarakat')
                return redirect()->route('masyarakat.dashboard');

                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
