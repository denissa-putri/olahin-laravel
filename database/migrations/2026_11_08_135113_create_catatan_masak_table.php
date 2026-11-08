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
        Schema::create('catatan_masak', function (Blueprint $table) {
            $table->integer('id_catatan', true);
            $table->integer('id_user')->index('id_user');
            $table->integer('id_resep')->index('id_resep');
            $table->text('teks_catatan')->nullable();
            $table->string('file_audio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_masak');
    }
};
