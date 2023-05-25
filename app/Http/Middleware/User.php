<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::guard('user')->check()){
            if(Auth::guard('user')->user()->status == 'Aktif'){
                return $next($request);
            }

            if(Auth::guard('user')->user()->status == 'Non-aktif'){
                Auth::guard('user')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('view-login')->with(['error' => 'Akun telah dinonaktifkan. Hubungi admin untuk mengetahui informasi lebih lanjut']);
            }
        }

        if(Auth::guard('admin')->check()){
            return redirect()->route('admin-view-dashboard');
        }
        
        return redirect()->route('view-login');

    }
}
