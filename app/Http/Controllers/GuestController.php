<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function index(): View {
        return view('welcome');
    }
}
