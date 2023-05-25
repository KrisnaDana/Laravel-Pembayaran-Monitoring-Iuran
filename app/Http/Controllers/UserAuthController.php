<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserAuthController extends Controller
{

    public function viewRegister(): View {
        return view('user.register');
    }

    public function register(Request $request): RedirectResponse {
        $validated = $request->validate([
            'username' => 'required|alpha_dash:ascii|min:3|max:20|unique:App\Models\User,username',
            'nama' => 'required|string|min:1|max:100',
            'telepon' => 'required|numeric',
            'alamat' => 'required|string|min:1|max:255',
            'password' => 'required|string|min:8|max:20|same:konfirmasi_password',
            'konfirmasi_password' => 'required|string|min:8|max:20|same:password'
        ]);
        $user = array(
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'nama' => $validated['nama'],
            'telepon' => $validated['telepon'],
            'alamat' => $validated['alamat'],
            'verifikasi' => 'Belum terverifikasi',
            'status' => 'Aktif',
        );
        User::create($user);
        return redirect()->route('view-login')->with(['success' => 'Berhasil membuat akun.']);
    }

    public function viewLogin(): View {
        return view('user.login');
    }

    public function login(Request $request): RedirectResponse {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('user')->attempt($validated)){
            $request->session()->regenerate();
            return redirect()->intended(route('view-dashboard'));
        }else{
            return redirect()->route('view-login')->with(['error' => 'Username dan Password tidak sesuai.']);
        }
    }

    public function logout(Request $request): RedirectResponse {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('view-login');
    }

    public function dashboard(): View {
        return view('user.dashboard');
    }

    public function profile(): View {
        return view('user.profile');
    }

    public function editProfile(): RedirectResponse {
        //
    }

    public function viewVerifikasi(): View {
        $user = Auth::guard('user')->user();
        return view('user.verifikasi', compact('user'));
    }

    public function verifikasi(Request $request): RedirectResponse {
        $validated = $request->validate([
            'file_verifikasi' => 'required|file|mimes:pdf|max:5120'
        ]);
        $id = Auth::guard('user')->user()->id;
        $user = User::find($id);
        if($user->verifikasi == "Terverifikasi" || $user->verifikasi == "Mengajukan verifikasi"){
            return redirect()->route('view-verifikasi');
        }
        if(!empty($file_verifikasi)){
            File::delete(public_path('/verifikasi-user/').$user->file_verifikasi);
        }
        $file_verifikasi = $request->file('file_verifikasi');
        $filename = $user->username. "." . $file_verifikasi->getClientOriginalExtension();
        $path = public_path('/verifikasi-user');
        $file_verifikasi->move($path, $filename);
        $user->file_verifikasi = $filename;
        $user->verifikasi = 'Mengajukan verifikasi';
        $user->save();
        return redirect()->route('view-login')->with(['success' => 'Berhasil membuat akun.']);
    }
}
