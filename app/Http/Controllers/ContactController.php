<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        // Kirim email ke admin (ubah alamat email sesuai kebutuhan)
        Mail::to('ijuldi77@gmail.com')->send(new ContactMail($request->judul, $request->pesan));

        return back()->with('success', 'Pesan Anda telah berhasil dikirim.');
    }
}
