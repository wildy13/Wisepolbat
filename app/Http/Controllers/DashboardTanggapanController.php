<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailVerificationMail;
use App\Mail\NotificationMail;
use App\Mail\PelaporNotifikasiLaporanDitolakMail;
use App\Notifications\MyNotification;
use App\Notifications\PelaporNotifikasiLaporanDitolak;
use Illuminate\Support\Facades\Mail;

class DashboardTanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'pesan' => 'required'
        ]);

        if ($request->is_petugas) {
            $validateData['petugas_id'] = Auth::guard('petugas')->user()->id;
            if ($request->level == 'manajemen_investigasi') {
                $validateData['level'] = 'manajemen_investigasi';
            }
            if ($request->level == 'manajemen_pelapor') {
                $validateData['level'] = 'manajemen_pelapor';
            }
            if ($request->level == 'admin_pelapor') {
                $validateData['level'] = 'admin_pelapor';
            }
        }
        if ($request->is_pelapor) {
            $validateData['user_id'] = Auth::guard('pelapor')->user()->id;
            if ($request->level == 'manajemen_pelapor') {
                $validateData['level'] = 'manajemen_pelapor';
            }
        }

        $validateData['report_id'] = $request->reportId;
        Tanggapan::create($validateData);

        if ($request->adminTolakLaporan || $request->manajemenTolakLaporan) {
            $report = Report::find($request->reportId);
            $report->update(['status' => 'Ditolak']);
            $pelapor = User::find($report->user->id);
            $pesan = strip_tags($request->pesan);

            $pelapor->notify(new PelaporNotifikasiLaporanDitolak($report, $pesan));
            Mail::send(new PelaporNotifikasiLaporanDitolakMail($pelapor, $report, $pesan));

            return redirect('/dashboard/report')->with('success', '<b>Laporan Berhasil Ditolak</b>, Laporan tidak akan diproses lebih lanjut');
        }

        return redirect('/dashboard/report')->with('success', '<b>Tanggapan Berhasil Terikirim</b>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function show(Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanggapan $tanggapan)
    {
        //
    }
}
