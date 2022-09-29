<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;;

class DashboardUbahPasswordController extends Controller
{
    public function index()
    {
        return view('Dashboard.ubahPassword');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
            'konfirmasi_password_baru' => 'same:password_baru',
        ]);

        if (Auth::guard('pelapor')->check()) {
            if (Hash::check($request->password_lama, Auth::user()->password)) {
                User::find(Auth::user()->id)->update(['password' => Hash::make($request->password_baru)]);
                return back()->with('success', '<b>Password Berhasil Diubah</b>');
            } else {
                return back()->with('failed', '<b>Password Gagal Diubah</b>');
            }
        }

        if (Auth::guard('petugas')->check()) {
            if (Hash::check($request->password_lama, Auth::user()->password)) {
                Petugas::find(Auth::user()->id)->update(['password' => Hash::make($request->password_baru)]);
                return back()->with('success', '<b>Password Berhasil Diubah</b>');
            } else {
                return back()->with('failed', '<b>Password Gagal Diubah</b>');
            }
        }
    }
}
