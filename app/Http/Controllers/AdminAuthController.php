<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function viewLogin(): View {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse {
        //
    }

    public function logout(): RedirectResponse {
        //
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
