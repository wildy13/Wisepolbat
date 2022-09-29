<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PelaporNotifikasiLaporanDiterimaMail extends Mailable
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
            ->subject('Laporan Diterima')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $this->report->user,
                'pesan' => 'Laporan anda dengan judul ' . $this->report->title . ' telah Disetujui. Laporan anda akan diteruskan ke pihak manajemen untuk dilakukan verifikasi.'
            ]);
    }
}
