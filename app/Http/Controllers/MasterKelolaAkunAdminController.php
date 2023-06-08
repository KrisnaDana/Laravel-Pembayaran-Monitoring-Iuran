<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class MasterKelolaAkunAdminController extends Controller
{
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

        return redirect(route('admin-master-view-list-admin'))->with(['success' => 'Input data berhasil dilakukan!']);
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
            'password_admin' => 'nullable|min:6',
        ]);

        $admin->nama = $request->nama_admin;
        $admin->username = $request->username_admin;
        $admin->password = $request->has('password_admin') ? $request->password_admin : $admin->password;
        $admin->role = $admin->role;

        $admin->save();
        return redirect(route('admin-master-edit-admin', $admin->id))->with(['success' => 'Input data berhasil dilakukan!']);
    }
}
