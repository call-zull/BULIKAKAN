<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusUserChanged extends Notification
{
    use Queueable;
    protected $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $newStatus)
    {
        $this->newStatus = $newStatus;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
   public function toMail(object $notifiable): MailMessage
{
    return (new MailMessage)
        ->subject('Perubahan Status Akun Anda')
        ->greeting('Halo ' . $notifiable->username . ',')
        ->line('Status akun Anda telah diubah menjadi "' . $this->newStatus . '".')
        ->action('Lihat Profil', url('/profile'))
        ->line('Terima kasih telah menggunakan Bulikakan!');
}


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
     public function toArray($notifiable)
    {
        return [
            'message' => 'Status akun Anda telah diubah menjadi "' . $this->newStatus . '".',
        ];
    }
}
