<?php

namespace App\Http\Controllers;

use App\Models\Alokasi;
use App\Models\Iuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAlokasiController extends Controller
{
    public function previewIuran()
    {
        $alokasis = Alokasi::all();
        $iurans = Iuran::all();
        return view('admin.alokasi.preview', compact('alokasis', 'iurans'));
    }

    public function viewAlokasi($id)
    {
        $iurans = Iuran::find($id);
        $alokasis = Alokasi::all();
        return view('admin.alokasi.view', compact('alokasis', 'iurans'));
    }

    public function createAlokasi($id)
    {
        $alokasis = Alokasi::all();
        $iurans = Iuran::find($id);
        return view('admin.alokasi.create', compact('alokasis', 'iurans'));
    }

    public function storeAlokasi(Request $request, $id)
    {
        $validated = $request->validate([
            'alokasi_name' => 'required|string|min:1|max:100',
            'alokasi_deskripsi' => 'required|string|min:1|max:255',
            'alokasi_foto' => 'file|image|max:2048',
            'alokasi_jumlah' => 'required|integer',
            // 'alokasi_iuran' => 'required|exists:iurans,id'
        ]);

        $alokasi = array(
            'nama' => $validated['alokasi_name'],
            'deskripsi' => $validated['alokasi_deskripsi'],
            'jumlah' => $validated['alokasi_jumlah'],
            'iuran_id' => $id
        );

        if ($request->hasFile('alokasi_foto')) {
            $file = $request->file('alokasi_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('alokasi_foto', $filename);
            $alokasi['foto'] = $filename;
        }

        DB::table('alokasis')->insert($alokasi);
        return redirect()->route('admin-view-alokasi', ['id' => $id]);
    }

    public function deleteAlokasi($iuranId, $alokasiId)
    {
        // Retrieve the minimarket and product based on their IDs
        $iurans = Iuran::find($iuranId);
        $alokasis = Alokasi::find($alokasiId);

        if ($alokasis) {
            // Perform the delete operation
            $alokasis->delete();
            // You can add any additional logic or redirect to a specific page after deletion
            return redirect()->back()->with('success', 'Product deleted successfully.');
        }

        // If the product is not found, you can handle the appropriate response
        return redirect()->back()->with('error', 'Product not found.');
    }
}
