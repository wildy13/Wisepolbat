<?php

namespace App\Http\Controllers;

use App\Mail\AdminPesanBantuanMail;
use App\Mail\PelaporPesanBantuanMail;
use App\Models\PesanBantuan;
use App\Models\Petugas;
use App\Notifications\AdminNotifikasiPesanBantuanMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardPesanBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authorize('admin');
        return view('Dashboard.Petugas.adminPesanBantuan', [
            'messages' => PesanBantuan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'author_name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        $validateData['petugas_id'] = Petugas::where('is_admin', TRUE)->first()->id;
        $validateData['status'] = 'Belum Ditanggapi';
        $pesanbantuan = PesanBantuan::create($validateData);

        if ($pesanbantuan) {
            $admin = Petugas::where('is_admin', TRUE)->first();
            $admin->notify(new AdminNotifikasiPesanBantuanMasuk($pesanbantuan));
            Mail::send(new PelaporPesanBantuanMail());
            return redirect('/#bantuan')->with('success', '<center><b>Pesan Anda Berhasil Terkirim,</b> <br>silahkan menunggu balasan dari kami melalui email anda</center>');
        } else {
            return redirect('/#bantuan')->with('failed', '<center><b>Pesan Anda Gagal Terkirim,</b></center>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PesanBantuan  $pesanbantuan
     * @return \Illuminate\Http\Response
     */
    public function show(PesanBantuan $pesanbantuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PesanBantuan  $pesanbantuan
     * @return \Illuminate\Http\Response
     */
    public function edit(PesanBantuan $pesanbantuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PesanBantuan  $pesanbantuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PesanBantuan $pesanbantuan)
    {

        $request->validate([
            'reply' => 'required'
        ]);
        $reply = $pesanbantuan->update(['reply' => strip_tags($request->reply), 'status' => 'Sudah Ditanggapi']);

        if ($reply) {
            Mail::send(new AdminPesanBantuanMail($pesanbantuan));
            return back()->with('success', '<center><b>Pesan Anda Berhasil Terkirim</b></center>');
        } else {
            return back()->with('failed', '<center><b>Pesan Anda Gagal Terkirim</b></center>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PesanBantuan  $pesanbantuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PesanBantuan $pesanbantuan)
    {
        //
    }
}
