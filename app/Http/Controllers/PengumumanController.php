<?php
namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\TipeBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
   public function index()
{
     $kehilangan = Pengumuman::with(['user', 'tipeBarang'])
        ->where('jenis_pengumuman', 'kehilangan')
        ->latest()
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->judul,
                'waktu' => \Carbon\Carbon::parse($item->waktu)->translatedFormat('d F Y'),
                'tempat' => $item->tempat,
                'tipe' => $item->tipeBarang->nama ?? 'Tidak diketahui',
                'image' => $item->foto_barang
                    ? asset('storage/' . $item->foto_barang)
                    : asset('logo/barang1.png'),
            ];
        });

    return view('pages.user.kehilangan.index', compact('kehilangan'));
}


    public function create()
    {
        $tipeBarangs = TipeBarang::all();
        // dd($tipeBarangs);
        return view('pages.user.kehilangan.create', compact('tipeBarangs'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto_barang' => 'nullable|image',
            'waktu' => 'required|date',
            'tempat' => 'required|string',
            'deskripsi' => 'required',
            'status' => 'required|in:publish,takedown',
            'kontak' => 'required|string',
            'jenis_pengumuman' => 'required|in:kehilangan,penemuan',
            'tipe_barang_id' => 'required|exists:tipe_barangs,id',
        ]);

        $data = $request->only([
            'judul', 'waktu', 'tempat', 'deskripsi', 'status',
            'kontak', 'jenis_pengumuman', 'tipe_barang_id'
        ]);

        $data['user_id'] = Auth::id(); // Gunakan user yang sedang login

        if ($request->hasFile('foto_barang')) {
            $data['foto_barang'] = $request->file('foto_barang')->store('foto_barang', 'public');
        }
        // dd($data);
        // dd($request->all());

        Pengumuman::create($data);

        return redirect()->route('kehilangan')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show(Pengumuman $pengumuman)
    {
        $pengumuman->load(['user', 'tipeBarang']);
        // return view('kehilangan.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        $tipeBarangs = TipeBarang::all();
        // return view('kehilangan.edit', compact('pengumuman', 'tipeBarangs'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'sometimes|string|max:255',
            'foto_barang' => 'nullable|image',
            'waktu' => 'sometimes|date',
            'tempat' => 'sometimes|string',
            'deskripsi' => 'sometimes',
            'status' => 'in:publish,takedown',
            'kontak' => 'sometimes|string',
            'jenis_pengumuman' => 'in:kehilangan,penemuan',
            'tipe_barang_id' => 'required|exists:tipe_barangs,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_barang')) {
            $data['foto_barang'] = $request->file('foto_barang')->store('foto_barang', 'public');
        }

        $pengumuman->update($data);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
