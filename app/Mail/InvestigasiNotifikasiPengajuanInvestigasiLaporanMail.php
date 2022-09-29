<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Petugas;

class InvestigasiNotifikasiPengajuanInvestigasiLaporanMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $investigasi = Petugas::where('is_investigation_team', TRUE)->first();
        return $this
            ->to($investigasi->email)
            ->subject('Laporan Masuk')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $investigasi,
                'pesan' => 'Halo Tim Investigasi, ada laporan baru masuk di dashboard anda. <br> Silahkan Periksa !'
            ]);
    }
}
