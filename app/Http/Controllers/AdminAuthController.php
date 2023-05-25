<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function viewLogin(): View {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if(Auth::guard('admin')->attempt($validated)){
            $request->session()->regenerate();
            return redirect()->intended(route('admin-view-dashboard'));
        }else{
            return redirect()->route('admin-view-login')->with(['error' => 'Username dan Password tidak sesuai.']);
        }
    }

    public function logout(Request $request): RedirectResponse {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin-view-login');
    }

    public function dashboard(): View {
        return view('admin.dashboard');
    }

    public function profile(): View {
        return view('admin.profile');
    }

    public function editProfile(): RedirectResponse {
        //
    }
}
