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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id_user', true);
            $table->string('username', 50)->unique('username');
            $table->string('password');
            $table->string('email', 100);
            $table->string('kategori_mhs', 50)->nullable();
            $table->string('foto_profil')->nullable()->default('default.png');
            $table->text('deskripsi')->nullable();
            $table->string('hobi')->nullable();
            $table->enum('role', ['admin', 'user'])->nullable()->default('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
