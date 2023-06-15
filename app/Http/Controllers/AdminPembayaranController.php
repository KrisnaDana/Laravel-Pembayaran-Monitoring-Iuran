<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Iuran;
use App\Models\Pembayaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminPembayaranController extends Controller
{
    public function pilihIuran(): View {
        $iurans = Iuran::all();
        return view('admin.pembayaran.pilih-iuran', compact('iurans'));
    }

    public function index($id): View {
        $pembayarans = Pembayaran::where('iuran_id', $id)->get();
        $iuran_id = $id;
        if(Auth::guard('admin')->user()->role == 'Master'){
            $master = true;
        }else {
            $master = false;
        }
        return view('admin.pembayaran.index', compact('pembayarans', 'iuran_id', 'master'));
    }

    public function read($id, $pembayaran_id): View {
        $pembayaran = Pembayaran::find($pembayaran_id);
        $iuran_id = $id;
        return view('admin.pembayaran.read', compact('pembayaran', 'iuran_id'));
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
