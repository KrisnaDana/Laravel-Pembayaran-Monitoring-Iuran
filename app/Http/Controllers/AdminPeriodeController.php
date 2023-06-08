<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Iuran;
use Illuminate\Http\RedirectResponse;

class AdminPeriodeController extends Controller
{
    public function pilihIuran(): View {
        $iurans = Iuran::all();
        return view('admin.pembayaran.pilih-iuran', compact('iurans'));
    }

    public function index($id): View {
        //
    }
}
