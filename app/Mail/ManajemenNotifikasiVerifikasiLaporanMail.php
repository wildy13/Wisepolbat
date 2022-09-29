<?php

namespace App\Mail;

use App\Models\Petugas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ManajemenNotifikasiVerifikasiLaporanMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function sendEmail()
    {
    }

    public function build()
    {
        return $this
            ->subject('Verifikasi Laporan')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $this->user,
                'pesan' => 'Halo, ada laporan baru masuk di dashboard anda. <br> Silahkan Periksa !'
            ]);
    }
}
