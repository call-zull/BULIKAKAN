<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $judul;
    public $pesan;
    public $lampiran;

   
    public function __construct($judul, $pesan, $lampiran = null)
    {
        $this->judul = $judul;
        $this->pesan = $pesan;
        $this->lampiran = $lampiran;
    }


    public function build()
{
    $email = $this->subject($this->judul)
                  ->view('emails.contact')
                  ->with([
                      'judul' => $this->judul,
                      'pesan' => $this->pesan,
                  ]);

    if ($this->lampiran && Storage::exists($this->lampiran)) {
        $email->attachFromStorage($this->lampiran);
    }

    return $email;
}
}
