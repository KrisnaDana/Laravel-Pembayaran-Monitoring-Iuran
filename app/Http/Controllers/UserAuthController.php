<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserAuthController extends Controller
{
    public function viewLogin(): View {
        return view('user.login');
    }

    public function login(Request $request): RedirectResponse {
        //
    }

    public function logout(): RedirectResponse {
        //
    }

    public function dashboard(): View {
        return view('user.dashboard');
    }

    public function profile(): View {
        return view('user.profile');
    }

    public function editProfile(): RedirectResponse {
        //
    }
}
