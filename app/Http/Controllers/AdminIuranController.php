<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iuran;
use App\Models\Periode;
use App\Models\Alokasi;
use App\Models\Pembayaran;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminIuranController extends Controller
{

    public function viewIuran() {
        // dd(Auth::guard('admin')->user()->role == 'Master');
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
        ]);

        $iurans = new Iuran;
        $iurans->nama = $request->nama;
        $iurans->deskripsi = $request->deskripsi;
        $iurans->tujuan_transfer = $request->tujuan_transfer;
        $iurans->jumlah = $request->jumlah;
        $iurans->terkumpul = '0';
        $iurans->tersisa = '0';
        $iurans->status = $request->status;
        $iurans->save();
        
        // if ($request->hasFile('gambar')) {
        //     $file = $request->file('gambar');
        //     $filename = time() . '_iuran_' . $file->getClientOriginalName();
        //     $file->move('gambar', $filename);
        //     $iurans['gambar'] = $filename;
        // }
        
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
                Iuran::where('id', $id)->update(['gambar' => $nama_image]);
            }
        }

        return redirect()->route('admin-view-iuran')->with('success','Berhasil menambah iuran');;
    }

    public function editIuran($id) {
        $iuran = Iuran::find($id);
        return view('admin.iuran.editIuran', compact('iuran'));
    }

    public function updateIuran($id, Request $request) {
        // dd($request);
        $this->validate($request,[
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tujuan_transfer' => 'nullable|string',
            'jumlah' => 'required|integer',
            'status' => 'required',
        ]);

        $periodeIsExist = Periode::where('iuran_id', $id)->first();
        $pembayaranIsExist = Pembayaran::where('iuran_id', $id)->first();
        $iurans = Iuran::find($id);
        if (($periodeIsExist === null && $pembayaranIsExist === null) || $request->jumlah == $iurans->jumlah) {
            $iurans->nama = $request->nama;
            $iurans->deskripsi = $request->deskripsi;
            $iurans->tujuan_transfer = $request->tujuan_transfer;
            $iurans->jumlah = $request->jumlah;
            $iurans->status = $request->status;
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
            if ($id && $request->hasFile('gambar')) {
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
            return redirect()->route('admin-view-iuran')->with('success','Berhasil menambah iuran');
        }else{
            return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Tidak bisa mengubah jumlah iuran.']);
        }
    }

    public function previewIuran($id) {
        $iuran = Iuran::find($id);
        return view('admin.iuran.previewIuran', compact('iuran'));
    }

    public function deleteIuran($id)
    {
        $periodeIsExist = Periode::where('iuran_id', $id)->first();
        $pembayaranIsExist = Pembayaran::where('iuran_id', $id)->first();
        $alokasiIsExist = Alokasi::where('iuran_id', $id)->first();
        // dd($periodeIsExist === null && $pembayaranIsExist === null && $alokasiIsExist === null);
        $iuran = Iuran::find($id);

        if (Auth::guard('admin')->user()->role == 'Admin') {
            if ($periodeIsExist === null && $pembayaranIsExist === null && $alokasiIsExist === null) {
                $iuran->delete();
            }
        } else if ((Auth::guard('admin')->user()->role == 'Master')){
            Periode::where('iuran_id', $id)->delete();
            Pembayaran::where('iuran_id',$id)->delete();
            Alokasi::where('iuran_id',$id)->delete();
            $iuran->delete();
        }
        
        return redirect()->route('admin-view-iuran')->with('error','Gagal hapus iuran');
    }
}
