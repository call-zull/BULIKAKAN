<?php
namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
{
    $kehilangan = Pengumuman::kehilangan()
        ->where('status', 'publish') // ✅ hanya tampilkan yang publish
        ->with('tipeBarang')
        ->latest()
        ->take(9)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->judul,
                'waktu' => optional($item->waktu)->translatedFormat('d F Y'),
                'tempat' => $item->tempat,
                'tipe' => $item->tipeBarang->nama ?? '-',
                'image' => $item->foto_barang
                    ? asset('storage/' . $item->foto_barang)
                    : asset('logo/barang1.png'),
            ];
        });

    $penemuan = Pengumuman::penemuan()
        ->where('status', 'publish') // ✅ hanya tampilkan yang publish
        ->with('tipeBarang')
        ->latest()
        ->take(9)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->judul,
                'waktu' => optional($item->waktu)->translatedFormat('d F Y'),
                'tempat' => $item->tempat,
                'tipe' => $item->tipeBarang->nama ?? '-',
                'image' => $item->foto_barang
                    ? asset('storage/' . $item->foto_barang)
                    : asset('logo/barang1.png'),
            ];
        });

    $carousels = Carousel::where('is_published', true)->get();
    $totalKehilangan = Pengumuman::kehilangan()->where('status', 'publish')->count();
    $totalPenemuan = Pengumuman::penemuan()->where('status', 'publish')->count();
    $totalSemua = $totalKehilangan + $totalPenemuan;


    return view('pages.user.home', compact(
    'kehilangan',
    'penemuan',
    'carousels',
    'totalKehilangan',
    'totalPenemuan',
    'totalSemua'
    ));

}

}