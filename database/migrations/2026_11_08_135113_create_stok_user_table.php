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
        Schema::create('stok_user', function (Blueprint $table) {
            $table->integer('id_stok', true);
            $table->integer('id_user')->index('id_user');
            $table->integer('id_bahan')->nullable();
            $table->string('nama_bahan_custom', 100)->nullable();
            $table->string('kategori_custom', 50)->nullable();
            $table->string('kuantitas', 50);
            $table->date('tanggal_kadaluarsa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_user');
    }
};
