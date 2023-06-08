<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Iuran;
use App\Models\Pembayaran;
use Illuminate\Http\RedirectResponse;

class AdminPembayaranController extends Controller
{
    public function pilihIuran(): View {
        $iurans = Iuran::all();
        return view('admin.pembayaran.pilih-iuran', compact('iurans'));
    }

    public function index($id): View {
        $pembayaran = Pembayaran::all();
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function read($id): View {
        //
    }

    public function viewCreate(): View {
        //
    }

    public function create(): RedirectResponse {
        //
    }

    public function konfirmasi($id): RedirectResponse {
        //
    }
}
