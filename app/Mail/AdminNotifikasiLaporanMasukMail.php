<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Petugas;

class AdminNotifikasiLaporanMasukMail extends Mailable
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
        $admin = Petugas::where('is_admin', TRUE)->first();
        return $this
            ->to($admin->email)
            ->subject('Laporan Masuk')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $admin,
                'pesan' => 'Halo Admin, ada laporan baru masuk di dashboard anda. <br> Silahkan Periksa !'
            ]);
    }
}
