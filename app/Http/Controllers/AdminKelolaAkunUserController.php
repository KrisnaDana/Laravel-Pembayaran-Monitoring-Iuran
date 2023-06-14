<?php

namespace App\Http\Controllers;

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
            'upload_foto' => 'required|image|file||max:4096',
        ]);

        $tambah_user = array(
            'username' => $request->username_user,
            'password' => Hash::make($request->password_user),
            'nama' => $request->nama_user,
            'telepon' => $request->telepon_user,
            'alamat' => $request->alamat_user,
            'verifikasi' => 'Terverifikasi',
            'status' => 'Aktif',
        );

        $user = User::create($tambah_user);

        if ($request->hasFile('upload_foto')) {
            $file = $request->file('upload_foto');
            $filename = Str::slug($request['nama_user']) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('/images/verifikasi-users');
            $file->move($path, $filename);

            $user->file_verifikasi = $filename; // Simpan nama file foto ke kolom 'file_verifikasi' pada tabel user
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
            'verifikasi_user' => 'required',
            'catatan_verifikasi_user' => 'required',
            'status_user' => 'required',
            'upload_foto' => 'image|file||max:4096',
        ]);

        $user->username = $request->username_user;
        $user->nama = $request->nama_user;
        $user->telepon = $request->telepon_user;
        $user->alamat = $request->alamat_user;
        $user->verifikasi = $request->verifikasi_user;
        $user->catatan_verifikasi = $request->catatan_verifikasi_user;
        $user->status = $request->status_user;

        $new_password = Hash::make($request->password_user);
        if ($user->password != $new_password) {
            $user->password = $new_password;
        }

        $user->file_verifikasi = $request->has('upload_foto') ? $request->upload_foto : $user->file_verifikasi;

        $user->save();
        return redirect(route('admin-edit-user', $user->id))->with(['toast.type' => 'success', 'toast.message' => 'User edited successfully.']);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with(['toast.type' => 'success', 'toast.message' => 'User deleted successfully.']);
    }

    public function deleteFotoUser($id)
    {
        $user = User::find($id);
        $foto = $user->file_verifikasi;

        if ($foto) {
            $filePath = public_path('images/verifikasi-users/' . $foto);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Hapus nama file dari atribut file_verifikasi pada model User
            $user->file_verifikasi = null;
            $user->save();
        }

        return view('admin.admin-kelola-user.adminEditUser', compact('user'))->with(['toast.type' => 'success', 'toast.message' => 'Foto user deleted successfully.']);
    }
}
