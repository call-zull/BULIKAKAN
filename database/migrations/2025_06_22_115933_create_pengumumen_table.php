<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke users
            $table->string('judul');
            $table->string('foto_barang')->nullable(); // Path foto
            $table->datetime('waktu');
            $table->string('tempat');
            $table->text('deskripsi');
            $table->enum('status', ['publish', 'takedown'])->default('publish');
            $table->string('kontak');
            $table->enum('jenis_pengumuman', ['kehilangan', 'penemuan']);
            $table->string('tipe_barang');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
