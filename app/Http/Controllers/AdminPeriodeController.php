<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Iuran;
use App\Models\Periode;
use App\Models\PeriodeBayar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminPeriodeController extends Controller
{
    public function pilihIuran(): View {
        $iurans = Iuran::all();
        return view('admin.periode.pilih-iuran', compact('iurans'));
    }

    public function index($id): View {
        $periodes = Periode::where('iuran_id', $id)->get();
        $iuran_id = $id;
        return view('admin.periode.index', compact('periodes', 'iuran_id'));
    }

    public function read($id, $periode_id): View {
        $periode = Periode::find($periode_id);
        $periode_bayars = PeriodeBayar::where('periode_id', $periode_id)->get();
        $iuran_id = $id;
        return view('admin.periode.read', compact('periode', 'periode_bayars', 'iuran_id'));
    }

    public function viewCreate($id): View {
        $iuran = Iuran::find($id);
        return view('admin.periode.create', compact('iuran'));
    }


    public function create($id, Request $request): RedirectResponse {
        $validated = $request->validate([
            'mulai' => 'required|date_format:Y-m-d|before_or_equal:berakhir',
            'berakhir' => 'required|date_format:Y-m-d|after_or_equal:mulai'
        ]);
        $periodes = Periode::where('iuran_id', $id)->get();
        foreach($periodes as $periode){
            if($validated['mulai'] >= $periode->mulai && $validated['mulai'] <= $periode->akhir){
                return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Tanggal periode tidak boleh beririsan dengan periode lain.']);
            }
            if($validated['berakhir'] >= $periode->mulai && $validated['berakhir'] <= $periode->akhir){
                return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Tanggal periode tidak boleh beririsan dengan periode lain.']);
            }
            if($periode->mulai >= $validated['mulai'] && $periode->akhir <= $validated['berakhir']){
                return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Tanggal periode tidak boleh beririsan dengan periode lain.']);
            }
        }
        $periode = array(
            'iuran_id' => $id,
            'mulai' => Carbon::parse($validated['mulai'])->format('Y-m-d'),
            'akhir' => Carbon::parse($validated['berakhir'])->format('Y-m-d'),
            'jumlah' => 0
        );
        Periode::create($periode);
        return redirect()->route('admin-view-periode', ['id' => $id])->with(['toast.type' => 'success', 'toast.message' => 'Periode berhasil dibuat.']);
    }

    public function viewEdit($id, $periode_id): View {
        $periode = Periode::find($periode_id);
        $iuran_id = $id;
        return view('admin.periode.edit', compact('periode', 'iuran_id'));
    }

    public function edit($id, $periode_id, Request $request): RedirectResponse {
        $validated = $request->validate([
            'mulai' => 'required|date_format:Y-m-d|before_or_equal:berakhir',
            'berakhir' => 'required|date_format:Y-m-d|after_or_equal:mulai'
        ]);
        $periodes = Periode::where('iuran_id', $id)->get();
        foreach($periodes as $periode){
            if($periode->id == $periode_id){
                continue;
            }
            if($validated['mulai'] >= $periode->mulai && $validated['mulai'] <= $periode->akhir){
                return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Tanggal periode tidak boleh beririsan dengan periode lain.']);
            }
            if($validated['berakhir'] >= $periode->mulai && $validated['berakhir'] <= $periode->akhir){
                return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Tanggal periode tidak boleh beririsan dengan periode lain.']);
            }
            if($periode->mulai >= $validated['mulai'] && $periode->akhir <= $validated['berakhir']){
                return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Tanggal periode tidak boleh beririsan dengan periode lain.']);
            }
        }
        $periode = Periode::find($periode_id);
        $periode->mulai = $validated['mulai'];
        $periode->akhir = $validated['berakhir'];
        $periode->save();
        return redirect()->back()->with(['toast.type' => 'success', 'toast.message' => 'Periode berhasil dibuat.']);
    }
    
    public function delete($id, $periode_id): RedirectResponse {
        $periode_bayars = PeriodeBayar::where('periode_id', $periode_id)->get();
        $check = 0;
        foreach($periode_bayars as $periode_bayar){
            $check = 1;
            break;
        }
        if($check == 1){
            if(Auth::guard('admin')->user()->role == "Admin"){
                return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Hapus periode tidak diperbolehkan.']);
            }else if(Auth::guard('admin')->user()->role == "Master"){
                $periode_bayars->each->delete();
            }
        }
        $periode = Periode::find($periode_id);
        $periode->delete();
        return redirect()->back()->with(['toast.type' => 'success', 'toast.message' => 'Periode berhasil dihapus.']);
    }
}
