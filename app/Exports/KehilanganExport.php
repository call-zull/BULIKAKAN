<?php

namespace App\Exports;

use App\Models\Pengumuman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class KehilanganExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    protected $data;

    public function collection()
    {
        return $this->data = Pengumuman::kehilangan()->with(['user', 'tipeBarang'])->get();
    }

    public function map($item): array
    {
        return [
            '', // Gambar akan ditambahkan oleh WithDrawings
            $item->judul,
            $item->tempat,
            optional($item->waktu)->format('Y-m-d H:i'),
            $item->deskripsi,
            $item->status,
            $item->kontak,
            $item->tipeBarang->nama ?? '-',
            $item->user->name ?? '-',
        ];
    }

    public function headings(): array
    {
        return ['Gambar', 'Judul', 'Tempat', 'Waktu', 'Deskripsi', 'Status', 'Kontak', 'Tipe Barang', 'Pelapor'];
    }

    public function drawings()
    {
        $drawings = [];

        foreach ($this->data as $index => $item) {
            if ($item->foto_barang && file_exists(public_path('storage/' . $item->foto_barang))) {
                $drawing = new Drawing();
                $drawing->setName('Foto');
                $drawing->setDescription('Foto Barang');
                $drawing->setPath(public_path('storage/' . $item->foto_barang));
                $drawing->setHeight(60);
                $drawing->setCoordinates('A' . ($index + 2)); // Mulai dari baris ke-2 karena baris 1 = heading
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
}
