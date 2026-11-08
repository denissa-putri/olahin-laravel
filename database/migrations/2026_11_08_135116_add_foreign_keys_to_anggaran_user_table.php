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
        Schema::table('anggaran_user', function (Blueprint $table) {
            $table->foreign(['id_user'], 'anggaran_user_ibfk_1')->references(['id_user'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggaran_user', function (Blueprint $table) {
            $table->dropForeign('anggaran_user_ibfk_1');
        });
    }
};
