<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;

class UserPembayaranController extends Controller
{
    public function index(){
        $user = Auth::guard('user')->user();
        $pembayarans = Pembayaran::where('user_id', $user->id)->get();
        return view('user.pembayaran.index', compact('pembayarans'));
    }

    public function read($id){
        $pembayaran = Pembayaran::find($id);
        return view('user.pembayaran.read', compact('pembayaran'));
    }

    public function edit($id){
        $pembayaran = Pembayaran::find($id);
        return view('user.pembayaran.edit', compact('pembayaran'));
    }

    public function editSubmit($id, Request $request){
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required|file|image|max:10000',
        ]);

        $pembayaran = Pembayaran::find($id);
        $user = Auth::guard('user')->user();
        $image = $request->file('bukti_pembayaran');
        $filename = $user->username . '-' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/bukti-transfer-user');
        $image->move($path, $filename);

        $pembayaran->jumlah = $validated['jumlah'];
        $pembayaran->bukti_transfer = $filename;
        $pembayaran->status = "Mengajukan pembayaran";
        $pembayaran->save();
        return redirect()->route('index-pembayaran')->with(['toast.type' => 'success', 'toast.message' => 'Berhasil melakukan pembayaran. Menunggu verifikasi admin.']);
    }
}
