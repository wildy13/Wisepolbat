<?php

namespace App\Http\Controllers;

use App\Mail\AdminNotifikasiLaporanMasukMail;
use App\Mail\InvestigasiNotifikasiPengajuanInvestigasiLaporanMail;
use App\Mail\ManajemenNotifikasiLaporanSelesaiMail;
use App\Mail\ManajemenNotifikasiRevisiLaporanMail;
use App\Mail\NotificationMail as MailNotificationMail;
use App\Mail\PelaporNotifikasiLaporanDiterimaMail;
use App\Models\Petugas;
use App\Models\PihakTerlibat;
use App\Models\Report;
use App\Notifications\AdminNotifikasiLaporanMasuk;
use App\Mail\ManajemenNotifikasiVerifikasiLaporanMail;
use App\Mail\PelaporNotifikasiLaporanDiinvestigasiMail;
use App\Mail\PelaporNotifikasiLaporanSelesaiMail;
use App\Models\Tanggapan;
use App\Notifications\InvestigasiNotifikasiPengajuanInvestigasiLaporan;
use App\Notifications\ManajemenNotifikasiLaporanSelesai;
use App\Notifications\ManajemenNotifikasiRevisiLaporan;
use App\Notifications\ManajemenNotifikasiVerifikasiLaporan;
use App\Notifications\NotificationMail;
use App\Notifications\PelaporNotifikasiLaporanDiinvestigasi;
use App\Notifications\PelaporNotifikasiLaporanDiterima;
use App\Notifications\PelaporNotifikasiLaporanSelesai;
use Illuminate\Http\Request;
use Nette\Utils\Validators;
use GuzzleHttp\Client;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Whoops\Run;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Mail\Message;

class DashboardReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $suspect;
    public $validateData;

    public function index()
    {

        if (Auth::guard('petugas')->check()) {
            if (Auth::guard('petugas')->user()->is_admin) {
                $this->authorize('admin');
                return view('Dashboard.daftarLaporan', [
                    'reports' => Report::all()
                ]);
            }

            if (Auth::guard('petugas')->user()->is_management) {
                $this->authorize('manajemen');
                return view('Dashboard.daftarLaporan', [
                    'reports' => Report::all(),
                ]);
            }

            if (Auth::guard('petugas')->user()->is_investigation_team) {
                $this->authorize('investigasi');
                return view('Dashboard.daftarLaporan', [
                    'reports' => Report::all(),
                ]);
            }
        }

        if (Auth::guard('pelapor')->check()) {
            $this->authorize('pelapor');
            return view('Dashboard.daftarLaporan', [
                'reports' => Report::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('pelapor');
        return view('Dashboard.buatLaporan');
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
            'category' => 'required',
            'title' => 'required',
            'lampiran' => 'file|required',
            'description' => 'required',
            'grecaptcha' => 'required'
        ]);

        $grecaptcha = $request->grecaptcha;
        $client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                [
                    'secret' => env('GOOGLE_CAPTCHA_SECRET'),
                    'response' => $grecaptcha
                ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        if ($body) {
            $jumlahSuspect = count($request->nama);
            for ($a = 0; $a < $jumlahSuspect; $a++) {
                $this->suspect .= $request->nama[$a];
                $this->suspect .= ',' . $request->jabatan[$a];
                $this->suspect .= ',' . $request->klasifikasi[$a] . ';';
            }

            $validateData['file_uploaded'] = $request->file('lampiran')->store('file_uploaded');
            $validateData['description'] = strip_tags($validateData['description']);
            $validateData['user_id'] = auth()->user()->id;
            $validateData['status'] = 'Belum Disetujui';
            $validateData['suspect'] = $this->suspect;
            $report = Report::create($validateData);
            $admin = Petugas::where('is_admin', TRUE)->first();
            // $jumlahAdmin = count($admin);
            // for ($x = 0; $x < $jumlahAdmin; $x++) {
            //     $admin[$x]->notify(new AdminNotifikasiLaporanMasuk($report));
            // }
            $admin->notify(new AdminNotifikasiLaporanMasuk($report));
            Mail::send(new AdminNotifikasiLaporanMasukMail());
            return redirect('/dashboard/report')->with('success', 'Aduan Anda Berhasil Dikirim');
        } else {
            return back()->with('failed', '<b><center>Kode Captcha Tidak Valid</center></b>');
        }
        return back()->with('failed', ' <b><center>Aduan Tidak Tekirim !</center></b>');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $pihakTerkait = explode(';', $report->suspect);
        $jumlahPihakTerkait = (count($pihakTerkait));
        unset($pihakTerkait[$jumlahPihakTerkait - 1]);
        $this->suspect = NULL;
        $this->suspect = [];
        foreach ($pihakTerkait as $pt) {
            $pt = explode(',', $pt);
            $this->suspect[] = $pt;
        }
        $report->suspect = $this->suspect;

        if ($report->status === 'Verifikasi' || $report->status === 'Revisi') {
            return view('Dashboard.Petugas.manajemenRevisi', [
                'report' => $report
            ]);
        }

        if ($report->status === 'Belum Disetujui') {
            return view('Dashboard.Petugas.adminVerifikasi', [
                'report' => $report
            ]);
        }

        return redirect('/dashboard/report');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        if ($request->investigasiSelesai) {
            $request->validate([
                'investigation_note' => 'required',
                'investigation_result_attachment' => 'required|file'
            ]);
            $report->update([
                'investigation_note' => $request->investigation_note,
                'investigation_result_attachment' => $request->file('investigation_result_attachment')->store('file_uploaded')
            ]);
            $report->update(['status' => 'Selesai']);
            $report->user->notify(new PelaporNotifikasiLaporanSelesai($report));
            Mail::send(new PelaporNotifikasiLaporanSelesaiMail($report));
            $managements = Petugas::where('is_management', TRUE)->get();
            foreach ($managements as $management) {
                $management->notify(new ManajemenNotifikasiLaporanSelesai($report));
            }
            $managements = Petugas::where('is_management', TRUE)->get();
            foreach ($managements->toArray() as $management) {
                Mail::to($management['email'])->send(new ManajemenNotifikasiLaporanSelesaiMail($management['name'], $report));
            }
            return redirect('/dashboard/report')->with('success', '<b>Laporan Telah Selesai Diinvestigasi</b>');
        }

        if ($request->investigasiLaporan) {
            $report->update(['status' => 'Investigasi']);
            $report->user->notify(new PelaporNotifikasiLaporanDiinvestigasi($report));
            Mail::send(new PelaporNotifikasiLaporanDiinvestigasiMail($report));
            return redirect('/dashboard/report')->with('success', '<b>Status Laporan Berhasil Diubah Menjadi Investigasi</b>, laporan harus segera diinvestigasi');
        }

        if ($request->revisiLaporan) {
            $report->update(['status' => 'Revisi']);
            $manajemen = Petugas::where('is_management', TRUE)->first();
            $manajemen->notify(new ManajemenNotifikasiRevisiLaporan($report));
            Mail::send(new ManajemenNotifikasiRevisiLaporanMail($report));
            return redirect('/dashboard/report')->with('success', '<b>Status Laporan Berhasil Diubah Menjadi Revisi</b>, laporan akan direvisi ulang oleh Manajemen.');
        }

        if ($request->persetujuanInvestigasi || $request->revisiSelesai) {
            $investigasi = Petugas::where('is_investigation_team', TRUE)->first();
            $investigasi->notify(new InvestigasiNotifikasiPengajuanInvestigasiLaporan($report));
            Mail::send(new InvestigasiNotifikasiPengajuanInvestigasiLaporanMail());
            $report->update(['status' => 'Persetujuan Investigasi']);

            if ($request->persetujuanInvestigasi) {
                return redirect('/dashboard/report')->with('success', '<b>Laporan Berhasil Diverifikasi</b>, Laporan akan diproses lebih lanjut ke tahap investigasi.');
            }

            if ($request->revisiSelesai) {
                return redirect('/dashboard/report')->with('success', '<b>Laporan Berhasil Direvisi</b>, Laporan akan diproses lebih lanjut ke tahap investigasi.');
            }
        }

        if ($request->revisi) {
            $validateData = $request->validate([
                'category' => 'required',
                'title' => 'required',
                'description' => 'required'
            ]);
            $jumlahSuspect = count($request->nama);
            for ($a = 0; $a < $jumlahSuspect; $a++) {
                $this->suspect .= $request->nama[$a];
                $this->suspect .= ',' . $request->jabatan[$a];
                $this->suspect .= ',' . $request->klasifikasi[$a] . ';';
            }
            $validateData['description'] = strip_tags($validateData['description']);
            $validateData['user_id'] = $report->user_id;
            $validateData['status'] = $report->status;
            $validateData['suspect'] = $this->suspect;
            $report->update($validateData);
            return redirect('/dashboard/report')->with('success', '<b>Laporan Berhasil Direvisi</b>');
        }

        if ($request->adminTerimaLaporan) {
            if ($report->status == 'Belum Disetujui') {
                $report->update(['status' => 'Verifikasi']);
                $pelapor = $report->user;
                $pelapor->notify(new PelaporNotifikasiLaporanDiterima($report));
                Mail::send(new PelaporNotifikasiLaporanDiterimaMail($report));
                $managements = Petugas::where('is_management', TRUE)->get();
                foreach ($managements as $management) {
                    $management->notify(new ManajemenNotifikasiVerifikasiLaporan($report));
                }

                $managements = Petugas::where('is_management', TRUE)->get();
                foreach ($managements->toArray() as $management) {
                    Mail::to($management['email'])->send(new ManajemenNotifikasiVerifikasiLaporanMail($management['name']));
                }

                return redirect('/dashboard/report')->with('success', '<b>Laporan Berhasil Disetujui</b>, Laporan Akan diteruskan ke pihak manajemen untuk diverifikasi');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        if ($report->file_uploaded) {
            Storage::delete($report->file_uploaded);
        }

        Report::destroy($report->id);
        return redirect('/dashboard/report')->with('success', 'Laporan Berhasil Dihapus');
    }
}
