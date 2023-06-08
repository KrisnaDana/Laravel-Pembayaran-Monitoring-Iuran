<?php

namespace App\Http\Controllers;

use App\Models\Alokasi;
use App\Models\Iuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAlokasiController extends Controller
{
    public function viewAlokasi()
    {
        
    }

    public function createAlokasi()
    {
        $alokasis = Alokasi::all();
        $iurans = Iuran::all();
        return view('admin.alokasi.view', compact('alokasis', 'iurans'));
    }

    public function storeAlokasi(Request $request)
    {
        dd($request);
        $validated = $request->validate([
            'alokasi_name' => 'required|string|min:1|max:100',
            'alokasi_deskripsi' => 'required|string|min:1|max:255',
            'alokasi_foto' => 'file|image|max:2048',
            'alokasi_jumlah' => 'required|integer',
            'alokasi_iuran' => 'required|exists:iurans,id'
        ]);

        $alokasi = array(
            'nama' => $validated['alokasi_name'],
            'deskripsi' => $validated['alokasi_deskripsi'],
            'foto' => $validated['alokasi_foto'],
            'jumlah' => $validated['alokasi_jumlah'],
            'iuran_id' => $validated['alokasi_iuran']
        );

        DB::table('alokasis')->insert($alokasi);
        return redirect()->route('product');
    }
}
