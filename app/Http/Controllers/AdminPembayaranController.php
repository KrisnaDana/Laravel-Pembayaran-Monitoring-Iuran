<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Iuran;
use App\Models\Pembayaran;
use App\Models\Periode;
use App\Models\User;
use App\Models\PeriodeBayar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
        $pembayaran->tanggal = Carbon::parse($pembayaran->created_at)->format('Y-m-d');
        return view('admin.pembayaran.read', compact('pembayaran', 'iuran_id'));
    }

    public function viewKonfirmasi($id, $pembayaran_id): View {
        $pembayaran = Pembayaran::find($pembayaran_id);
        $iuran_id = $id;
        $pembayaran->tanggal = Carbon::parse($pembayaran->created_at)->format('Y-m-d');
        $statuses = array(
            'Perbaikan pembayaran',
            'Terverifikasi',
            'Dibatalkan',
        );
        return view('admin.pembayaran.konfirmasi', compact('pembayaran', 'iuran_id', 'statuses'));
    }

    public function konfirmasi($id, $pembayaran_id, Request $request): RedirectResponse {
        $validated = $request->validate([
            'status' => 'required|in:Perbaikan pembayaran,Terverifikasi,Dibatalkan',
            'catatan' => 'nullable|string|max:1000'
        ]);
        $pembayaran = Pembayaran::find($pembayaran_id);
        $pembayaran->status = $validated['status'];
        if(!empty($validated['catatan'])){
            $pembayaran->catatan = $validated['catatan'];
        }
        $pembayaran->save();

        if($validated['status'] == 'Terverifikasi'){
            $iuran = $pembayaran->iuran;
            $periodes = Periode::where('iuran_id', $id)->with('periode_bayars')->orderBy('mulai', 'asc')->get();
            $total_iuran = 0;
            foreach($periodes as $periode){
                $continue = 0;
                if(isset($periode->periode_bayars) && count($periode->periode_bayars) > 0){
                    foreach($periode->periode_bayars as $p){
                        if($p->user_id == $pembayaran->user_id && $p->status == "Lunas"){
                            $continue = 1;
                            break;
                        }else if($p->user_id == $pembayaran->user_id && $p->status == "Belum lunas"){
                            $continue = 1;
                            $total_iuran = $total_iuran + ($iuran->jumlah - $p->jumlah);
                            break;
                        }
                    }
                    if($continue == 1){
                        continue;
                    }
                }
                $total_iuran = $total_iuran + $iuran->jumlah;
            }

            $jumlah_pembayaran = $pembayaran->jumlah;
            if($jumlah_pembayaran > $total_iuran){
                return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Jumlah pembayaran tidak boleh melebihi jumlah iuran. Silahkan buatkan periode yang baru.']);
            }
            
            $belum_lunas = 0;
            foreach($periodes as $periode){
                if($belum_lunas == 1){
                    break;
                }
                if(isset($periode->periode_bayars) && count($periode->periode_bayars) > 0){
                    foreach($periode->periode_bayars as $p){
                        if($p->user_id == $pembayaran->user_id && $p->status == "Belum lunas"){
                            if($jumlah_pembayaran >= ($iuran->jumlah - $p->jumlah)){
                                $temp = $p->jumlah;
                                $p->jumlah = $iuran->jumlah;
                                $p->status = "Lunas";
                                $p->save();
                                $periode->jumlah = $periode->jumlah + ($iuran->jumlah - $temp);
                                $periode->save();
                                $jumlah_pembayaran = $jumlah_pembayaran - ($iuran->jumlah - $temp);
                            }else{
                                $p->jumlah = $p->jumlah + $jumlah_pembayaran;
                                $p->save();
                                $periode->jumlah = $periode->jumlah + $jumlah_pembayaran;
                                $periode->save();
                                $jumlah_pembayaran = 0;
                            }
                            $belum_lunas = 1;
                            break;
                        }
                    }
                }
            }

            $periode_bayar = [];
            if($jumlah_pembayaran > 0){
                foreach($periodes as $periode){
                    $lunas = 0;
                    if(isset($periode->periode_bayars) && count($periode->periode_bayars) > 0){
                        foreach($periode->periode_bayars as $p){
                            if($p->user_id == $pembayaran->user_id && $p->status == "Lunas"){
                                $lunas = 1;
                                break;
                            }
                        }
                        if($lunas == 1){
                            continue;
                        }
                    }
                    if($jumlah_pembayaran >= $iuran->jumlah){
                        array_push($periode_bayar, ['periode_id' => $periode->id, 'user_id' => $pembayaran->user_id, 'jumlah' => $iuran->jumlah, 'status' => 'Lunas', 'created_at' => date('Y-m-d H:i:s')]);
                        $periode->jumlah = $periode->jumlah + $iuran->jumlah;
                        $periode->save();
                        $jumlah_pembayaran = $jumlah_pembayaran - $iuran->jumlah;
                    }else if($jumlah_pembayaran < $iuran->jumlah && $jumlah_pembayaran > 0){
                        array_push($periode_bayar, ['periode_id' => $periode->id, 'user_id' => $pembayaran->user_id, 'jumlah' => $jumlah_pembayaran, 'status' => 'Belum lunas', 'created_at' => date('Y-m-d H:i:s')]);
                        $periode->jumlah = $periode->jumlah + $jumlah_pembayaran;
                        $periode->save();
                        $jumlah_pembayaran = 0;
                    }else{
                        break;
                    }
                }
                PeriodeBayar::insert($periode_bayar);
            }
        }
        return redirect()->route('admin-view-pembayaran', ['id' => $id])->with(['toast.type' => 'success', 'toast.message' => 'Berhasil mengubah status pembayaran.']);
    }

    public function viewCreate($id): View {
        $iuran_id = $id;
        $users = User::all();
        return view('admin.pembayaran.create', compact('iuran_id', 'users'));
    }

    public function create($id, Request $request): RedirectResponse {
        $validated = $request->validate([
            'user' => 'required',
            'jumlah' => 'required|integer|min:0|max:1000000000'
        ]);

        $iuran = Iuran::find($id);
        $user = User::find($id);

        $pembayaran = array(
            'user_id' => $user->id,
            'iuran_id' => $iuran->id,
            'jumlah' => $validated['jumlah'],
            'metode' => 'Offline',
            'status' => 'Terverifikasi',
        );
        Pembayaran::create($pembayaran);

        $periodes = Periode::where('iuran_id', $id)->with('periode_bayars')->orderBy('mulai', 'asc')->get();
        $total_iuran = 0;
        foreach($periodes as $periode){
            $continue = 0;
            if(isset($periode->periode_bayars) && count($periode->periode_bayars) > 0){
                foreach($periode->periode_bayars as $p){
                    if($p->user_id == $user->id && $p->status == "Lunas"){
                        $continue = 1;
                        break;
                    }else if($p->user_id == $user->id && $p->status == "Belum lunas"){
                        $continue = 1;
                        $total_iuran = $total_iuran + ($iuran->jumlah - $p->jumlah);
                        break;
                    }
                }
                if($continue == 1){
                    continue;
                }
            }
            $total_iuran = $total_iuran + $iuran->jumlah;
        }

        $jumlah_pembayaran = $validated['jumlah'];
        if($jumlah_pembayaran > $total_iuran){
            return redirect()->back()->with(['toast.type' => 'danger', 'toast.message' => 'Jumlah pembayaran tidak boleh melebihi jumlah iuran. Silahkan buatkan periode yang baru.']);
        }
        
        $belum_lunas = 0;
        foreach($periodes as $periode){
            if($belum_lunas == 1){
                break;
            }
            if(isset($periode->periode_bayars) && count($periode->periode_bayars) > 0){
                foreach($periode->periode_bayars as $p){
                    if($p->user_id == $user->id && $p->status == "Belum lunas"){
                        if($jumlah_pembayaran >= ($iuran->jumlah - $p->jumlah)){
                            $temp = $p->jumlah;
                            $p->jumlah = $iuran->jumlah;
                            $p->status = "Lunas";
                            $p->save();
                            $periode->jumlah = $periode->jumlah + ($iuran->jumlah - $temp);
                            $periode->save();
                            $jumlah_pembayaran = $jumlah_pembayaran - ($iuran->jumlah - $temp);
                        }else{
                            $p->jumlah = $p->jumlah + $jumlah_pembayaran;
                            $p->save();
                            $periode->jumlah = $periode->jumlah + $jumlah_pembayaran;
                            $periode->save();
                            $jumlah_pembayaran = 0;
                        }
                        $belum_lunas = 1;
                        break;
                    }
                }
            }
        }

        $periode_bayar = [];
        if($jumlah_pembayaran > 0){
            foreach($periodes as $periode){
                $lunas = 0;
                if(isset($periode->periode_bayars) && count($periode->periode_bayars) > 0){
                    foreach($periode->periode_bayars as $p){
                        if($p->user_id == $user->id && $p->status == "Lunas"){
                            $lunas = 1;
                            break;
                        }
                    }
                    if($lunas == 1){
                        continue;
                    }
                }
                if($jumlah_pembayaran >= $iuran->jumlah){
                    array_push($periode_bayar, ['periode_id' => $periode->id, 'user_id' => $user->id, 'jumlah' => $iuran->jumlah, 'status' => 'Lunas', 'created_at' => date('Y-m-d H:i:s')]);
                    $periode->jumlah = $periode->jumlah + $iuran->jumlah;
                    $periode->save();
                    $jumlah_pembayaran = $jumlah_pembayaran - $iuran->jumlah;
                }else if($jumlah_pembayaran < $iuran->jumlah && $jumlah_pembayaran > 0){
                    array_push($periode_bayar, ['periode_id' => $periode->id, 'user_id' => $user->id, 'jumlah' => $jumlah_pembayaran, 'status' => 'Belum lunas', 'created_at' => date('Y-m-d H:i:s')]);
                    $periode->jumlah = $periode->jumlah + $jumlah_pembayaran;
                    $periode->save();
                    $jumlah_pembayaran = 0;
                }else{
                    break;
                }
            }
            PeriodeBayar::insert($periode_bayar);
        }
        return redirect()->route('admin-view-pembayaran', ['id' => $id])->with(['toast.type' => 'success', 'toast.message' => 'Berhasil menambah pembayaran.']);
    }

}
