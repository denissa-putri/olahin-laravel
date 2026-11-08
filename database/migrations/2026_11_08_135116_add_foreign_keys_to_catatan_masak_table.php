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
        Schema::table('catatan_masak', function (Blueprint $table) {
            $table->foreign(['id_user'], 'catatan_masak_ibfk_1')->references(['id_user'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_resep'], 'catatan_masak_ibfk_2')->references(['id_resep'])->on('master_resep')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catatan_masak', function (Blueprint $table) {
            $table->dropForeign('catatan_masak_ibfk_1');
            $table->dropForeign('catatan_masak_ibfk_2');
        });
    }
};
