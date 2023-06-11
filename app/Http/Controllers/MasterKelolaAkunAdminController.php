<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MasterKelolaAkunAdminController extends Controller
{
    // MANAJEMEN ADMIN

    public function viewListAdmin()
    {
        $admins = Admin::all();
        return view('admin.kelola-admin.listAdmin', compact('admins'));
    }

    public function createAdmin()
    {
        return view('admin.kelola-admin.createAdmin');
    }

    public function createAdminSubmit(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_admin' => 'required|min:5',
            'username_admin' => 'required|unique:admins,username',
            'password_admin' => 'required|min:6',
        ]);

        $tambah_admin = array(
            'nama' => $request->nama_admin,
            'username' => $request->username_admin,
            'password' => Hash::make($request->password_admin),
            'role' => 'Admin'
        );

        Admin::create($tambah_admin);

        return redirect(route('admin-master-view-list-admin'))->with(['toast.type' => 'success', 'toast.message' => 'Admin deleted successfully.']);
    }

    public function detailAdmin($id)
    {
        $admin = Admin::find($id);
        return view('admin.kelola-admin.detailAdmin', compact('admin'));
    }

    public function editAdmin($id)
    {
        $admin = Admin::find($id);
        return view('admin.kelola-admin.editAdmin', compact('admin'));
    }

    public function editAdminSubmit(Request $request, $id): RedirectResponse
    {
        $admin = Admin::find($id);

        $request->validate([
            'nama_admin' => 'required|min:5',
            'username_admin' => 'required|unique:admins,username',
            'password_admin' => 'required|min:6',
        ]);

        $admin->nama = $request->nama_admin;
        $admin->username = $request->username_admin;
        $admin->password = Hash::make($request->password_admin);
        // $admin->password = $request->has('password_admin') ? $request->password_admin : $admin->password;
        $admin->role = $admin->role;

        $admin->save();
        return redirect(route('admin-master-edit-admin', $admin->id))->with(['toast.type' => 'success', 'toast.message' => 'Admin deleted successfully.']);
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->back()->with(['toast.type' => 'success', 'toast.message' => 'Admin deleted successfully.']);
        // return redirect()->route('admin-master-view-list-admin')->with('error', 'Data tidak berhasil dihapus');
    }


    // MANAJEMEN USER

    public function viewListUser()
    {
        $users = User::all();
        return view('admin.master-kelola-user.masterListUser', compact('users'));
    }

    public function createUser()
    {
        return view('admin.master-kelola-user.masterCreateUser');
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

        return redirect(route('admin-master-view-list-user'))->with(['toast.type' => 'success', 'toast.message' => 'User created successfully.']);
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.master-kelola-user.masterEditUser', compact('user'));
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

        return view('admin.master-kelola-user.masterEditUser', compact('user'))->with(['toast.type' => 'success', 'toast.message' => 'Foto user deleted successfully.']);
    }
}
