<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $judul;
    public $pesan;

    public function __construct($judul, $pesan)
    {
        $this->judul = $judul;
        $this->pesan = $pesan;
    }

    public function build()
    {
        return $this->subject($this->judul)
                    ->view('emails.contact')
                    ->with([
                        'judul' => $this->judul,
                        'pesan' => $this->pesan,
                    ]);
    }
}
