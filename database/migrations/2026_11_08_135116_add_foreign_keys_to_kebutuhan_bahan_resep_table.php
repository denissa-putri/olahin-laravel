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
        Schema::table('kebutuhan_bahan_resep', function (Blueprint $table) {
            $table->foreign(['id_resep'], 'kebutuhan_bahan_resep_ibfk_1')->references(['id_resep'])->on('master_resep')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_bahan'], 'kebutuhan_bahan_resep_ibfk_2')->references(['id_bahan'])->on('master_bahan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kebutuhan_bahan_resep', function (Blueprint $table) {
            $table->dropForeign('kebutuhan_bahan_resep_ibfk_1');
            $table->dropForeign('kebutuhan_bahan_resep_ibfk_2');
        });
    }
};
