<?php

namespace App\Mail;

use App\Models\Petugas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PelaporPesanBantuanMail extends Mailable
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
            ->subject('Pesan Bantuan')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $admin,
                'pesan' => 'Admin, ada Pesan Bantuan masuk di dashboard anda. Silahkan periksa !'
            ]);
    }
}
