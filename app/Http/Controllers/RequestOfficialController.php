<?php

namespace App\Http\Controllers;

use App\Models\RequestOfficial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RequestOfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.official.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        try {
            $validated = $request->validate([
                'nama_instansi' => 'required|string|max:255',
                'alasan' => 'required|string',
                'dokumen_pendukung' => 'required|file|mimes:pdf,jpg,png|max:2048',
            ]);

            $path = $request->file('dokumen_pendukung')->store('dokumen', 'public');

            RequestOfficial::create([
                'user_id' => Auth::id(),
                'nama_instansi' => $validated['nama_instansi'],
                'alasan' => $validated['alasan'],
                'dokumen_pendukung' => $path,
                'status_request' => 'diproses',
            ]);
            return redirect()->route('profile.index')->with('success', 'Permintaan telah dikirim.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return back()
                ->with('create_failed', 'Terjadi kesalahan saat menyimpan: ' . $e->getMessage())
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(RequestOfficial $requestOfficial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestOfficial $requestOfficial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestOfficial $requestOfficial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestOfficial $requestOfficial)
    {
        //
    }
}
