<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PelaporNotifikasiLaporanDiinvestigasiMail extends Mailable
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
        return $this
            ->to($this->report->user->email)
            ->subject('Laporan Diinvestigasi')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $this->report->user,
                'pesan' => 'Hi, Laporan anda dengan judul <i>' . $this->report->title . '</i> telah disetujui untuk dilakukan investigasi. Laporan anda akan diinvestigasi oleh pihak yang berwenang.'
            ]);
    }
}
