<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;

class PelaporNotifikasiLaporanDitolak extends Notification
{
    use Queueable;

    protected $reoport;
    protected $pesan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($report, $pesan)
    {
        $this->report = $report;
        $this->pesan = $pesan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'report' => $this->report,
            'pesan' => $this->pesan
        ];
    }
}
