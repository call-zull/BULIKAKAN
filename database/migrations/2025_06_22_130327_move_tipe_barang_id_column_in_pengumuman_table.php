<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropForeign(['tipe_barang_id']);
            $table->dropColumn('tipe_barang_id');
        });
        
        Schema::table('pengumuman', function (Blueprint $table) {
            // Tambahkan kembali kolom di posisi yang diinginkan
            $table->foreignId('tipe_barang_id')
                ->after('jenis_pengumuman')
                ->constrained('tipe_barangs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropForeign(['tipe_barang_id']);
            $table->dropColumn('tipe_barang_id');

            // Kembalikan ke posisi awal jika ingin
            $table->foreignId('tipe_barang_id')
                ->constrained('tipe_barangs'); 
        });
    }
};
