<?php

namespace App\Exports;

use App\Models\Pengumuman;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PenemuanExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    protected $data;
    protected $rowCounter = 2; // Excel row starts from 2 because 1 is for headings

    public function __construct()
    {
        $this->data = Pengumuman::penemuan()->with('user', 'tipeBarang')->latest()->get();
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return ['Gambar', 'Judul', 'Waktu', 'Tempat', 'Deskripsi', 'Status', 'Kontak', 'Pelapor'];
    }

    public function map($row): array
    {
        return [
            '', // Placeholder for image
            $row->judul,
            optional($row->waktu)->format('Y-m-d H:i'),
            $row->tempat,
            $row->deskripsi,
            $row->status,
            $row->kontak,
            optional($row->user)->name ?? '-',
        ];
    }

    public function drawings(): array
    {
        $drawings = [];

        foreach ($this->data as $index => $row) {
            if (!$row->foto_barang || !file_exists(storage_path('app/public/' . $row->foto_barang))) {
                $this->rowCounter++;
                continue;
            }

            $drawing = new Drawing();
            $drawing->setPath(storage_path('app/public/' . $row->foto_barang));
            $drawing->setHeight(80);
            $drawing->setCoordinates('A' . $this->rowCounter);
            $drawings[] = $drawing;

            $this->rowCounter++;
        }

        return $drawings;
    }
}
