<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardUbahProfilController extends Controller
{
    public function index()
    {
        return view('Dashboard.ubahProfil', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        if (Auth::guard('pelapor')->check()) {
            $updatePelapor = User::find(Auth::user()->id)->update(['name' => $request->name]);
            if ($updatePelapor) {
                return back()->with('success', '<b>Profil Anda Berhasil Diubah</b>');
            } else {
                return back()->with('failed', '<b>Profil Anda Gagal Diubah</b>');
            }
        }

        if (Auth::guard('petugas')->check()) {
            $updatePetugas = Petugas::find(Auth::user()->id)->update(['name' => $request->name]);
            if ($updatePetugas) {
                return back()->with('success', '<b>Profil Anda Berhasil Diubah</b>');
            } else {
                return back()->with('failed', '<b>Profil Anda Gagal Diubah</b>');
            }
        }
    }
}
