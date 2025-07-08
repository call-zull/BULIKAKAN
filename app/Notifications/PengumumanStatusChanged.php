<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Pengumuman;

class PengumumanStatusChanged extends Notification
{
    use Queueable;

      protected $pengumuman;
    protected $newStatus;

    public function __construct(Pengumuman $pengumuman, $newStatus)
    {
        $this->pengumuman = $pengumuman;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Status Pengumuman Anda Berubah')
            ->greeting('Halo ' . $notifiable->username)
            ->line('Status pengumuman "' . $this->pengumuman->judul . '" telah diubah menjadi "' . $this->newStatus . '".')
            ->action('Lihat Pengumuman', url('/pengumuman/' . $this->pengumuman->id))
            ->line('Jika Anda merasa ini kesalahan, silakan hubungi admin.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Status pengumuman "' . $this->pengumuman->judul . '" telah diubah menjadi "' . $this->newStatus . '".',
            'pengumuman_id' => $this->pengumuman->id,
            'status' => $this->newStatus,
        ];
    }
}
