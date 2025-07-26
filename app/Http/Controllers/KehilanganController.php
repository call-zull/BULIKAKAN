<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\TipeBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class KehilanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengumuman::kehilangan()
            ->where('status', 'publish')
            ->with('tipeBarang', 'user');

        // Filter: Search
        // if ($request->filled('search')) {
        //     $query->where('judul', 'like', '%' . $request->search . '%');
        // }
        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                    ->orWhereJsonContains('tags', $search);
            });
        }


        // Filter: Tipe
        if ($request->filled('tipe')) {
            $query->whereHas('tipeBarang', function ($q) use ($request) {
                $q->where('nama', $request->tipe);
            });
        }

        $kehilangan = $query->latest()
            ->paginate(9)
            ->withQueryString() // supaya query string (search, tipe) tetap saat ganti halaman
            ->through(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->judul,
                    'waktu' => \Carbon\Carbon::parse($item->waktu)->translatedFormat('d F Y'),
                    'tempat' => $item->tempat,
                    'tipe' => $item->tipeBarang->nama ?? 'Tidak diketahui',
                    'image' => $item->foto_barang
                        ? asset('storage/' . $item->foto_barang)
                        : asset('logo/barang1.png'),
                    'user_name' => $item->user->username ?? 'Tidak diketahui',
                    'is_official' => $item->user->status_user === 'official',
                    'selesai' => $item->selesai
                ];
            });

        $tipeBarangs = TipeBarang::all();

        return view('pages.user.kehilangan.index', compact('kehilangan', 'tipeBarangs'));
    }


    public function create()
    {
        $tipeBarangs = TipeBarang::all();
        return view('pages.user.kehilangan.create', compact('tipeBarangs'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        //   dd($request->all());

        try {
            $request->validate([
                'judul' => 'required|string|max:255', // untuk uji coba error
                'foto_barang' => 'required|file|mimes:jpeg,jpg,png|max:6000',
                'waktu' => 'required|date',
                'tempat' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'kontak' => 'required|string|max:255',
                'jenis_pengumuman' => 'in:kehilangan',
                'tipe_barang_id' => 'required|exists:tipe_barangs,id',
                'provinsi' => 'required|string',
                'kabupaten' => 'required|string',
                'kecamatan' => 'required|string',
                'kelurahan' => 'required|string',
            ]);

            $data = $request->only([
                'judul',
                'waktu',
                'tempat',
                'deskripsi',
                'status',
                'kontak',
                'tipe_barang_id',
                'provinsi',
                'kabupaten',
                'kecamatan',
                'kelurahan',
            ]);
            $data['jenis_pengumuman'] = 'kehilangan';
            $data['user_id'] = Auth::id();

            if ($request->hasFile('foto_barang')) {
                $data['foto_barang'] = $request->file('foto_barang')->store('foto_barang', 'public');
            }

            // dd($data);

            $text = $data['judul'] . ' ' . $data['deskripsi'];
            $data['tags'] = Pengumuman::generateTags($text);

            // dd($data);

            Pengumuman::create($data);

            return redirect()->route('kehilangan')->with('success', 'Pengumuman kehilangan berhasil ditambahkan.');
        } catch (ValidationException $e) {
            // biarkan Laravel redirect dan membawa $errors seperti biasa
            throw $e;
        } catch (\Exception $e) {
            return back()
                ->with('create_failed', 'Terjadi kesalahan saat menyimpan.')
                ->withInput();
        }
    }

    public function show(Pengumuman $pengumuman)
    {
        if ($pengumuman->jenis_pengumuman !== 'kehilangan') {
            abort(404);
        }

        $pengumuman->load(['user', 'tipeBarang']);
        return view('pages.user.kehilangan.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        if ($pengumuman->jenis_pengumuman !== 'kehilangan') {
            abort(404);
        }

        $tipeBarangs = TipeBarang::all();
        return view('pages.user.kehilangan.edit', compact('pengumuman', 'tipeBarangs'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        if ($pengumuman->jenis_pengumuman !== 'kehilangan') {
            abort(404);
        }

        // dd($request);

        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'foto_barang' => 'file|mimes:jpeg,jpg,png|max:6000',
                'waktu' => 'required|date',
                'tempat' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'kontak' => 'required|string|max:255',
                'tipe_barang_id' => 'required|exists:tipe_barangs,id',
                'provinsi' => $pengumuman->provinsi ? 'required|string' : 'nullable|string',
                'kabupaten' => $pengumuman->kabupaten ? 'required|string' : 'nullable|string',
                'kecamatan' => $pengumuman->kecamatan ? 'required|string' : 'nullable|string',
                'kelurahan' => $pengumuman->kelurahan ? 'required|string' : 'nullable|string',
                'selesai' => 'sometimes|boolean',
            ]);

            $data = $request->except('foto_barang');

            if ($request->hasFile('foto_barang')) {
                $data['foto_barang'] = $request->file('foto_barang')->store('foto_barang', 'public');
            }

            // dd($data);
            $text = $data['judul'] . ' ' . $data['deskripsi'];
            $data['tags'] = Pengumuman::generateTags($text);
            $pengumuman->update($data);

            return redirect()->route('kehilangan')->with('success', 'Pengumuman kehilangan berhasil diperbarui.');
        } catch (ValidationException $e) {
            throw $e; // agar tetap pakai $errors bawaan Laravel
        } catch (\Exception $e) {
            return back()
                ->with('update_failed', 'Gagal memperbarui: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->jenis_pengumuman !== 'kehilangan') {
            abort(404);
        }

        $pengumuman->delete();
        return redirect()->route('kehilangan')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
