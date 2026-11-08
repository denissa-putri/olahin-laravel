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
        Schema::create('berita_trending', function (Blueprint $table) {
            $table->integer('id_berita', true);
            $table->string('judul', 150);
            $table->string('gambar_url')->nullable();
            $table->string('link_tujuan');
            $table->integer('views')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_trending');
    }
};
