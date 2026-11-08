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
        Schema::create('weekly_grocery', function (Blueprint $table) {
            $table->integer('id_grocery', true);
            $table->integer('id_user')->index('id_user');
            $table->string('nama_barang', 150);
            $table->string('kuantitas', 50);
            $table->integer('harga');
            $table->string('kategori', 100)->nullable()->default('Grocery');
            $table->string('hari', 20);
            $table->integer('minggu_ke');
            $table->string('bulan_tahun', 7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_grocery');
    }
};
