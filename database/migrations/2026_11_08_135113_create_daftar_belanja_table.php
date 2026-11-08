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
        Schema::create('daftar_belanja', function (Blueprint $table) {
            $table->integer('id_belanja', true);
            $table->integer('id_user')->index('id_user');
            $table->integer('id_bahan')->index('id_bahan');
            $table->decimal('jumlah_kurang', 10);
            $table->boolean('status_beli')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_belanja');
    }
};
