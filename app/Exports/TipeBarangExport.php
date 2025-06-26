<?php

namespace App\Exports;

use App\Models\TipeBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TipeBarangExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TipeBarang::select('id', 'nama', 'created_at')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'created_at' => $item->created_at->format('Y-m-d H:i'),
                ];
            });
    }


    public function headings(): array
    {
        return ['ID', 'Nama', 'Dibuat'];
    }
}
