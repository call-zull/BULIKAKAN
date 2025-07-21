<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Storage;

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6048',
        ]);

        $gambarPath = null;

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('temp'); // simpan ke storage/app/temp
        }

        // Kirim email
        Mail::to('ijuldi77@gmail.com')->queue(new ContactMail(
            $request->judul,
            $request->pesan,
            $gambarPath // kirim hanya path relatif
        ));

        // (opsional) hapus file setelah email dikirim
        // if ($gambarPath) {
        //     Storage::delete($gambarPath);
        // }

        return back()->with('success', 'Pesan Anda telah berhasil dikirim.');
    }
}
