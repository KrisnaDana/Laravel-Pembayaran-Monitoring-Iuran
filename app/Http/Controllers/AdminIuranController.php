<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iuran;
use Illuminate\Support\Facades\DB;

class AdminIuranController extends Controller
{
    public function viewIuran() {
        $iurans = Iuran::all();
        return view('admin.iuran.viewIuran', compact('iurans'));
    }

    public function createIuran() {
        return view('admin.iuran.createIuran');
    }

    public function storeIuran(Request $request) {
        // dd($request);
        $this->validate($request,[
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tujuan_transfer' => 'nullable|string',
            'jumlah' => 'required|integer',
            'terkumpul' => 'nullable',
            'tersisa' => 'nullable',
            'status' => 'required',
            'jenis' => 'required',
            'mulai' => 'required',
            'akhir' => 'nullable',
            'jarak_periode' => 'nullable',
        ]);

        $iurans = new Iuran;
        $iurans->nama = $request->nama;
        $iurans->deskripsi = $request->deskripsi;
        $iurans->tujuan_transfer = $request->tujuan_transfer;
        $iurans->jumlah = $request->jumlah;
        $iurans->terkumpul = '0';
        $iurans->tersisa = '0';
        $iurans->status = $request->status;
        $iurans->jenis = $request->jenis;
        $iurans->mulai = $request->mulai;
        $iurans->akhir = $request->akhir;
        $iurans->jarak_periode = $request->jarak_periode;
        $iurans->save();

        // if ($request->hasFile('gambar')) {
        //     $gambar = $request->file('gambar');
        //     $filename = time() . '_iuran_' . $file->getClientOriginalName();
        //     $path = public_path('/iuran');

        //     $file->move('alokasi_foto', $filename); // Move the file to the 'alokasi_foto' directory in the public folder
        //     $alokasi['foto'] = $filename;
        // }
        
        $this->validate($request, [
            'gambar.*' => 'nullable|file|image',
        ]);

        // DB::table('iurans')->insert($validated);

        $id = Iuran::orderBy('id', 'DESC')->first()->id;
        if ($id) {
            $gambars = [];
            if(!empty($request->file('gambar'))) {
                foreach($request->file('gambar') as $gambar){
                    if($gambar->isValid()){
                        $nama_image = "iuran_".time()."_".$gambar->getClientOriginalName();
                        // Storage::putFileAs('public', $file, $nama_image);
                        $path = public_path('/gambar/iuran');
                        $gambar->move($path, $nama_image);
                        $gambars[] = [
                            'gambar' => $nama_image,
                        ];
                    }
                }
            }
            Iuran::where('id', $id)->update(['gambar' => $nama_image]);
        }

        return redirect()->route('admin-view-iuran')->with('success','Berhasil menambah iuran');;
    }
}
