<?php

namespace App\Mail;

use App\Models\ForgotPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $action_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($action_link)
    {
        $this->action_link = $action_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Reset Password')
            ->markdown('emails.auth.email_forgot_password', [
                'action_link' => $this->action_link
            ]);
    }
}
