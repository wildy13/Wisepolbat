<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPesanBantuanMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pesanBantuan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pesanBantuan)
    {
        $this->pesanBantuan = $pesanBantuan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->pesanBantuan->email)
            ->subject('Pesan Bantuan')
            ->markdown('emails.auth.email_notification_mail', [
                'user' => $this->pesanBantuan,
                'pesan' => $this->pesanBantuan->reply
            ]);
    }
}
