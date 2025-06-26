<?php

namespace Database\Seeders;

use App\Models\TipeBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipe = ['Elektronik', 'Aksesoris', 'Pribadi', 'Pakaian', 'lain-lain'];
        foreach ($tipe as $nama) {
            TipeBarang::create(['nama' => $nama]);
        }
    }
}
