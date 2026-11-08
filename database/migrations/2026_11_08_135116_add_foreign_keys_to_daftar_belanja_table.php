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
        Schema::table('daftar_belanja', function (Blueprint $table) {
            $table->foreign(['id_user'], 'daftar_belanja_ibfk_1')->references(['id_user'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_bahan'], 'daftar_belanja_ibfk_2')->references(['id_bahan'])->on('master_bahan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_belanja', function (Blueprint $table) {
            $table->dropForeign('daftar_belanja_ibfk_1');
            $table->dropForeign('daftar_belanja_ibfk_2');
        });
    }
};
