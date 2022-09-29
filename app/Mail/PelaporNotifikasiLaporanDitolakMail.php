<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PelaporNotifikasiLaporanDitolakMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pelapor;
    protected $report;
    protected $pesan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pelapor, $report, $pesan)
    {
        $this->pelapor = $pelapor;
        $this->report = $report;
        $this->pesan = $pesan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->pelapor->email)
            ->subject('Laporan Ditolak')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $this->pelapor,
                'pesan' => 'Hi, Laporan anda dengan judul ' . $this->report->title . ' telah Ditolak. <br>' . $this->pesan
            ]);
    }
}
