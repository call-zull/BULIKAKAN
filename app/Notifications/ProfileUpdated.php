<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProfileUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Profil Berhasil Diperbarui')
            ->greeting('Halo ' . $notifiable->username)
            ->line('Profil Anda telah berhasil diperbarui.')
            ->action('Lihat Profil', url('/profile'))
            ->line('Jika ini bukan Anda, segera hubungi admin.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Profil Anda telah berhasil diperbarui.',
        ];
    }
}
