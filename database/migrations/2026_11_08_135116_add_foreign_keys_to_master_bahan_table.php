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
        Schema::table('master_bahan', function (Blueprint $table) {
            $table->foreign(['id_kategori'], 'master_bahan_ibfk_1')->references(['id_kategori'])->on('master_kategori')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_bahan', function (Blueprint $table) {
            $table->dropForeign('master_bahan_ibfk_1');
        });
    }
};
