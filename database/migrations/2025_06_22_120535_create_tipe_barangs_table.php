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
        Schema::create('tipe_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique(); // e.g. 'Handphone', 'Kunci', dll
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipe_barangs');
    }
};
