<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Petugas;
use App\Notifications\ManajemenNotifikasiVerifikasiLaporan;

class ManajemenNotifikasiRevisiLaporanMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $manajemen = Petugas::where('is_management', TRUE)->first();
        return $this
            ->to($manajemen->email)
            ->subject('Revisi Laporan')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $manajemen,
                'pesan' => 'Halo, ada pengajuan perevisian laporan, dengan judul laporan ' . $this->report->title . '. <br> Silahkan Periksa !'
            ]);
    }
}
