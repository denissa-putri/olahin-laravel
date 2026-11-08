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
        Schema::create('anggaran_user', function (Blueprint $table) {
            $table->integer('id_anggaran', true);
            $table->integer('id_user')->index('id_user');
            $table->integer('target_bulanan')->default(0);
            $table->integer('total_pengeluaran_aktual')->default(0);
            $table->integer('minggu_ke');
            $table->string('bulan_tahun', 7);
            $table->string('kategori_terbanyak', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_user');
    }
};
