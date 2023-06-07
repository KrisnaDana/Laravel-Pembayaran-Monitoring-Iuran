<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Master
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->check()){
            if(Auth::guard('admin')->user()->role == 'Master'){
                return $next($request);
            }else {
                return redirect()->route('view-dashboard');
            }
        }

        if(Auth::guard('user')->check()){
            return redirect()->route('view-dashboard');
        }

        return $next($request);
    }
}
