<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PeriodeBayar;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminKelolaAkunUserController extends Controller
{
    // MANAJEMEN USER

    public function viewListUser()
    {
        $users = User::all();
        return view('admin.admin-kelola-user.adminListUser', compact('users'));
    }

    public function detailUser($id)
    {
        $user = User::find($id);
        return view('admin.admin-kelola-user.adminDetailUser', compact('user'));
    }

    public function createUser()
    {
        return view('admin.admin-kelola-user.adminCreateUser');
    }

    public function createUserSubmit(Request $request): RedirectResponse
    {
        $request->validate([
            'username_user' => 'required|unique:users,username',
            'password_user' => 'required|min:6',
            'nama_user' => 'required',
            'telepon_user' => 'required|numeric|digits_between:1,20',
            'alamat_user' => 'required',
            'file_verifikasi' => 'required|file|mimes:pdf|max:5120'
        ]);

        $tambah_user = array(
            'username' => $request->username_user,
            'password' => Hash::make($request->password_user),
            'nama' => $request->nama_user,
            'telepon' => $request->telepon_user,
            'alamat' => $request->alamat_user,
            'status' => 'Aktif',
        );

        $user = User::create($tambah_user);

        if ($request->hasFile('file_verifikasi')) {
            $file = $request->file('file_verifikasi');
            $filename = Str::slug($request['nama_user']) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('verifikasi-user');
            $file->move($path, $filename);

            $user->file_verifikasi = $filename; // Simpan nama file foto ke kolom 'file_verifikasi' pada tabel user
            $user->verifikasi = 'Terverifikasi';
            $user->save();
        } else {
            $user->verifikasi = 'Mengajukan verifikasi';
            $user->save();
        }

        return redirect(route('admin-view-list-user'))->with(['toast.type' => 'success', 'toast.message' => 'User created successfully.']);
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.admin-kelola-user.adminEditUser', compact('user'));
    }

    public function editUserSubmit(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        $request->validate([
            'username_user' => 'required|unique:users,username',
            'password_user' => 'required|min:6',
            'nama_user' => 'required',
            'telepon_user' => 'required|numeric|digits_between:1,20',
            'alamat_user' => 'required',
            // 'verifikasi_user' => 'required',
            // 'catatan_verifikasi_user' => 'required',
            'status_user' => 'required',
            // 'upload_foto' => 'image|file||max:4096',
        ]);

        $user->username = $request->username_user;
        $user->nama = $request->nama_user;
        $user->telepon = $request->telepon_user;
        $user->alamat = $request->alamat_user;
        // $user->verifikasi = $request->verifikasi_user;
        // $user->catatan_verifikasi = $request->catatan_verifikasi_user;
        $user->status = $request->status_user;

        $new_password = Hash::make($request->password_user);
        if ($user->password != $new_password) {
            $user->password = $new_password;
        }

        // $user->file_verifikasi = $request->has('upload_foto') ? $request->upload_foto : $user->file_verifikasi;

        $user->save();
        return redirect(route('admin-edit-user', $user->id))->with(['toast.type' => 'success', 'toast.message' => 'User edited successfully.']);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $pembayarans = Pembayaran::where('user_id', $user->id)->get();
        $periode_bayars = PeriodeBayar::where('user_id', $user->id)->get();

        if ($pembayarans->count() == 0 && $periode_bayars->count() == 0) {
            $pdf = $user->file_verifikasi;

            if ($pdf) {
                $filePath = public_path('verifikasi-user/' . $pdf);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                // Hapus nama file dari atribut file_verifikasi pada model User
                $user->file_verifikasi = null;
                $user->save();
            }

            $user->delete();
            return redirect()->back()->with(['toast.type' => 'success', 'toast.message' => 'User deleted successfully.']);
        } else {
            return redirect()->back()->with(['toast.type' => 'error', 'toast.message' => 'Only admin with master role can delete this user data.']);
        }
    }

    // public function deleteFotoUser($id)
    // {
    //     $user = User::find($id);
    //     $foto = $user->file_verifikasi;

    //     if ($foto) {
    //         $filePath = public_path('images/verifikasi-users/' . $foto);
    //         if (file_exists($filePath)) {
    //             unlink($filePath);
    //         }
    //         // Hapus nama file dari atribut file_verifikasi pada model User
    //         $user->file_verifikasi = null;
    //         $user->save();
    //     }

    //     return view('admin.admin-kelola-user.adminEditUser', compact('user'))->with(['toast.type' => 'success', 'toast.message' => 'Foto user deleted successfully.']);
    // }

    // Verifikasi User

    public function viewListUserVerifikasi()
    {
        $users = User::where('verifikasi', '!=', 'Terverifikasi')->get();
        return view('admin.admin-kelola-user.adminListVerifikasiUser', compact('users'));
    }

    public function detailVerifikasiUser($id)
    {
        $user = User::find($id);
        return view('admin.admin-kelola-user.adminDetailVerifikasiUser', compact('user'));
    }

    public function detailtVerifikasiUserSubmit(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        $request->validate([
            'catatan_verifikasi_user' => 'required',
        ]);

        $user->catatan_verifikasi = $request->catatan_verifikasi_user;
        $user->verifikasi = 'Terverifikasi';

        $user->save();
        return redirect(route('admin-view-list-verifikasi-user', $user->id))->with(['toast.type' => 'success', 'toast.message' => 'User approved successfully.']);
    }

    public function editVerifikasiUser($id)
    {
        $user = User::find($id);
        return view('admin.admin-kelola-user.adminEditVerifikasiUser', compact('user'));
    }

    public function editVerifikasiUserSubmit(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        $request->validate([
            'username_user' => 'required',
            'password_user' => 'required|min:6',
            'nama_user' => 'required',
            'telepon_user' => 'required|numeric|digits_between:1,20',
            'alamat_user' => 'required',
            // 'verifikasi_user' => 'required',
            // 'catatan_verifikasi_user' => 'required',
            'status_user' => 'required',
            // 'upload_foto' => 'image|file||max:4096',
        ]);

        if ($request->username_user != $user->username) {
            $user->username = $request->username_user;
        }

        $user->nama = $request->nama_user;
        $user->telepon = $request->telepon_user;
        $user->alamat = $request->alamat_user;
        // $user->verifikasi = $request->verifikasi_user;
        // $user->catatan_verifikasi = $request->catatan_verifikasi_user;
        $user->status = $request->status_user;

        $new_password = Hash::make($request->password_user);
        if ($user->password != $new_password) {
            $user->password = $new_password;
        }

        // $user->file_verifikasi = $request->has('upload_foto') ? $request->upload_foto : $user->file_verifikasi;

        $user->save();
        return redirect(route('admin-edit-verifikasi-user', $user->id))->with(['toast.type' => 'success', 'toast.message' => 'User edited successfully.']);
    }

    public function deleteVerifikasiUser($id)
    {
        $user = User::find($id);
        $pdf = $user->file_verifikasi;

        if ($pdf) {
            $filePath = public_path('verifikasi-user/' . $pdf);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Hapus nama file dari atribut file_verifikasi pada model User
            $user->file_verifikasi = null;
            $user->save();
        }

        $user->delete();
        return redirect()->back()->with(['toast.type' => 'success', 'toast.message' => 'User deleted successfully.']);
    }
}
