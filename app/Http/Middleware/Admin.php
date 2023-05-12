<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->check()){
            return $next($request);
        }

        if(Auth::guard('user')->check()){
            if(Auth::guard('user')->user()->status == 'Aktif'){
                return redirect()->route('view-dashboard');
            }

            if(Auth::guard('user')->user()->status == 'Belum aktif'){
                return redirect()->route('login')->with(['error' => 'Menunggu verifikasi akun']);
            }

            if(Auth::guard('user')->user()->status == 'Tidak aktif'){
                return redirect()->route('login')->with(['error' => 'Akun anda tidak aktif']);
            }
        }

        return redirect()->route('admin-view-login');
    }
}
