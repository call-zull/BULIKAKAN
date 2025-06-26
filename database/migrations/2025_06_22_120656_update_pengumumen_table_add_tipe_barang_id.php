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
            $table->foreignId('tipe_barang_id')->constrained('tipe_barangs')->onDelete('cascade');
            $table->dropColumn('tipe_barang'); // hapus kolom lama jika sudah tidak digunakan
        });
    }

    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropForeign(['tipe_barang_id']);
            $table->dropColumn('tipe_barang_id');
            $table->string('tipe_barang'); // restore kolom jika rollback
        });
    }
};
