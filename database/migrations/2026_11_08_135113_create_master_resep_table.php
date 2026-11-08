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
        Schema::create('master_resep', function (Blueprint $table) {
            $table->integer('id_resep', true);
            $table->integer('id_user')->nullable()->index('fk_resep_user');
            $table->string('judul_resep', 150);
            $table->text('instruksi_masak');
            $table->enum('kesulitan', ['Mudah', 'Sedang', 'Sulit'])->nullable()->default('Mudah');
            $table->integer('porsi')->default(1);
            $table->integer('waktu_memasak');
            $table->string('gambar_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_resep');
    }
};
