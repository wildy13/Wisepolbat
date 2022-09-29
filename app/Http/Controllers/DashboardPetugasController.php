<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');
        return view('Dashboard.Petugas.adminDaftarAkunPetugas', [
            'pengguna' => Petugas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        return view('Dashboard.Petugas.adminTambahAkunPetugas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:petugas',
            'email' => 'required|unique:petugas|email:dns',
            'password' => 'required|min:5',
            'confirmPassword' => 'required|same:password'
        ]);

        if ($request->level === 'manajemen') {
            $validateData['is_management'] = TRUE;
        } else {
            $validateData['is_investigation_team'] = TRUE;
        }

        $validateData['password'] = Hash::make($validateData['password']);
        $registration = Petugas::create($validateData);

        if ($registration) {
            return redirect('/dashboard/petugas')->with('success', '<span><center><b>Akun Petugas Telah Berhasil Ditambahkan</b></center></span>');
        } else {
            return redirect('/dashboard/petugas')->with('failed', '<span><center><b>Akun Petugas Gagal Ditambahkan</b></center></span>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petugas $petugas)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petugas $petugas)
    {
        //
    }
}
