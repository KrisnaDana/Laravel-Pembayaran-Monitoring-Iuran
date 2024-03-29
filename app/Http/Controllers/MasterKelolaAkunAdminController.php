<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Alokasi;
use App\Models\Pembayaran;
use App\Models\PeriodeBayar;
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
            'password_admin' => 'required|min:6|same:konfirmasi_password_admin',
            'konfirmasi_password_admin' => 'required|min:6|same:password_admin',
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
            'username_admin' => 'required|unique:admins,username,' . $id,
            'password_admin' => 'required|min:6|same:konfirmasi_password_admin',
            'konfirmasi_password_admin' => 'required|min:6|same:password_admin',
        ]);

        $admin->nama = $request->nama_admin;
        $admin->username = $request->username_admin;

        $new_password = Hash::make($request->password_admin);
        if ($admin->password != $new_password) {
            $admin->password = $new_password;
        }

        // $admin->password = Hash::make($request->password_admin);
        // $admin->password = $request->has('password_admin') ? $request->password_admin : $admin->password;
        $admin->role = $admin->role;

        $admin->save();
        return redirect(route('admin-master-edit-admin', $admin->id))->with(['toast.type' => 'success', 'toast.message' => 'Admin edited successfully.']);
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->back()->with(['toast.type' => 'success', 'toast.message' => 'Admin deleted successfully.']);
    }


    // MANAJEMEN USER

    public function viewListUser()
    {
        $users = User::all();
        return view('admin.master-kelola-user.masterListUser', compact('users'));
    }

    public function detailUser($id)
    {
        $user = User::find($id);
        return view('admin.master-kelola-user.masterDetailUser', compact('user'));
    }

    public function createUser()
    {
        return view('admin.master-kelola-user.masterCreateUser');
    }

    // public function createUserSubmit(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'username_user' => 'required|unique:users,username',
    //         'password_user' => 'required|min:6',
    //         'nama_user' => 'required',
    //         'telepon_user' => 'required|numeric|digits_between:1,20',
    //         'alamat_user' => 'required',
    //         'upload_foto' => 'image|file||max:4096',
    //     ]);

    //     $tambah_user = array(
    //         'username' => $request->username_user,
    //         'password' => Hash::make($request->password_user),
    //         'nama' => $request->nama_user,
    //         'telepon' => $request->telepon_user,
    //         'alamat' => $request->alamat_user,
    //         'status' => 'Aktif',
    //     );

    //     $user = User::create($tambah_user);

    //     if ($request->hasFile('upload_foto')) {
    //         $file = $request->file('upload_foto');
    //         $filename = Str::slug($request['nama_user']) . '-' . time() . '.' . $file->getClientOriginalExtension();
    //         $path = public_path('/images/verifikasi-users');
    //         $file->move($path, $filename);

    //         $user->file_verifikasi = $filename; // Simpan nama file foto ke kolom 'file_verifikasi' pada tabel user
    //         $user->verifikasi = 'Terverifikasi';
    //         $user->save();
    //     } else {
    //         $user->verifikasi = 'Mengajukan verifikasi';
    //         $user->save();
    //     }

    //     return redirect(route('admin-master-view-list-user'))->with(['toast.type' => 'success', 'toast.message' => 'User created successfully.']);
    // }

    public function createUserSubmit(Request $request): RedirectResponse
    {
        $request->validate([
            'username_user' => 'required|unique:users,username',
            'password_user' => 'required|min:6|same:konfirmasi_password_user',
            'konfirmasi_password_user' => 'required|min:6|same:password_user',
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
            $path = public_path('/verifikasi-user');
            $file->move($path, $filename);

            $user->file_verifikasi = $filename; // Simpan nama file foto ke kolom 'file_verifikasi' pada tabel user
            $user->verifikasi = 'Terverifikasi';
            $user->save();
        } else {
            $user->verifikasi = 'Mengajukan verifikasi';
            $user->save();
        }

        return redirect(route('admin-master-view-list-user'))->with(['toast.type' => 'success', 'toast.message' => 'User created successfully.']);
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.master-kelola-user.masterEditUser', compact('user'));
    }

    public function editUserSubmit(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        $request->validate([
            'username_user' => 'required|unique:users,username,' . $id,
            'password_user' => 'required|min:6|same:konfirmasi_password_user',
            'konfirmasi_password_user' => 'required|min:6|same:password_user',
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
        return redirect(route('admin-master-edit-user', $user->id))->with(['toast.type' => 'success', 'toast.message' => 'User edited successfully.']);
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

    public function viewListUserVerifikasi()
    {
        $users = User::where('verifikasi', '!=', 'Terverifikasi')->get();
        return view('admin.master-kelola-user.masterListVerifikasiUser', compact('users'));
    }

    public function detailVerifikasiUser($id)
    {
        $user = User::find($id);
        return view('admin.master-kelola-user.masterDetailVerifikasiUser', compact('user'));
    }

    public function detailtVerifikasiUserSubmit(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        $user->catatan_verifikasi = 'File sudah benar';
        $user->verifikasi = 'Terverifikasi';

        $user->save();
        return redirect(route('admin-master-view-list-verifikasi-user', $user->id))->with(['toast.type' => 'success', 'toast.message' => 'User approved successfully.']);
    }

    public function detailtVerifikasiUserRevisiSubmit(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        $request->validate([
            'catatan_verifikasi_user' => 'required',
        ]);

        $user->catatan_verifikasi = $request->catatan_verifikasi_user;
        $user->verifikasi = 'Perbaikan verifikasi';

        $user->save();
        return redirect(route('admin-master-view-list-verifikasi-user', $user->id))->with(['toast.type' => 'success', 'toast.message' => 'Users need to make revisions.']);
    }

    public function editVerifikasiUser($id)
    {
        $user = User::find($id);
        return view('admin.master-kelola-user.masterEditVerifikasiUser', compact('user'));
    }

    public function editVerifikasiUserSubmit(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        $request->validate([
            'username_user' => 'required|unique:users,username,' . $id,
            'password_user' => 'required|min:6|same:konfirmasi_password_user',
            'konfirmasi_password_user' => 'required|min:6|same:password_user',
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
        // $user->verifikasi = 'Perbaikan verifikasi';
        // $user->catatan_verifikasi = $request->catatan_verifikasi_user;
        $user->status = $request->status_user;

        $new_password = Hash::make($request->password_user);
        if ($user->password != $new_password) {
            $user->password = $new_password;
        }

        // $user->file_verifikasi = $request->has('upload_foto') ? $request->upload_foto : $user->file_verifikasi;

        $user->save();
        return redirect(route('admin-master-edit-verifikasi-user', $user->id))->with(['toast.type' => 'success', 'toast.message' => 'User edited successfully.']);
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
