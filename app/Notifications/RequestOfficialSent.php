<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RequestOfficialSent extends Notification
{
    use Queueable;

    public $requestOfficial;

    /**
     * Create a new notification instance.
     */
    public function __construct($requestOfficial)
    {
        $this->requestOfficial = $requestOfficial;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // bisa disesuaikan
    }

    /**
     * Get the mail representation of the notification.
     */
   public function toMail($notifiable)
{
    if ($notifiable->hasRole('admin')) {
        return $this->adminMail($notifiable);
    }

    return $this->userMail($notifiable);
}

protected function adminMail($notifiable)
{
    return (new MailMessage)
        ->subject('Ada Permintaan Menjadi Official')
        ->greeting('Halo Admin,')
        ->line('Pengguna dengan nama instansi "' . $this->requestOfficial->nama_instansi . '" telah mengajukan permintaan official.')
        ->action('Kelola Permintaan', url(route('admin.request-official.index'))) // ganti sesuai rute admin kamu
        ->line('Segera tinjau dan ambil tindakan.');
}

protected function userMail($notifiable)
{
    return (new MailMessage)
        ->subject('Request Official Telah Dikirim')
        ->greeting('Halo ' . $notifiable->username)
        ->line('Permintaan Anda untuk menjadi user official telah dikirim.')
        ->line('Instansi: ' . $this->requestOfficial->nama_instansi)
        ->line('Status: ' . $this->requestOfficial->status_request)
        ->action('Lihat Profil', url(route('profile.index')))
        ->line('Kami akan meninjau permintaan Anda secepatnya.');
}


    /**
     * Get the array representation of the notification.
     */
   public function toArray($notifiable)
{
    if ($notifiable->hasRole('admin')) {
        return [
            'message' => 'Ada permintaan official baru dari instansi "' . $this->requestOfficial->nama_instansi . '".',
            'link' => '/admin/request-officials',
        ];
    }

    return [
        'message' => 'Request official Anda telah dikirim dan sedang diproses.',
        'link' => route('profile.index'),
    ];
}

}
