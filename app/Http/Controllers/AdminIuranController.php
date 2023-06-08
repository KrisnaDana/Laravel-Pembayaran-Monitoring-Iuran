<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iuran;

class AdminIuranController extends Controller
{
    public function viewIuran() {
        $iurans = Iuran::all();
        return view('admin.iuran.viewIuran', compact('iurans'));
    }

    public function createIuran() {
        $iurans = Iuran::all();
        return view('admin.iuran.createIuran',compact('iurans'));
    }
}
