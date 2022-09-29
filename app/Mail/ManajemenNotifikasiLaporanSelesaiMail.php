<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Markdown;
use Illuminate\Queue\SerializesModels;

class ManajemenNotifikasiLaporanSelesaiMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $username, $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $report)
    {
        $this->username = $username;
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
            ->subject('Laporan Selesai')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $this->username,
                'pesan' => 'Laporan dengan judul <i>' . $this->report->title . '</i> telah selesai diinvestigasi. Silahkan Periksa Dashboard anda untuk melihat hasil investigasi tersebut ! '
            ]);
    }
}
