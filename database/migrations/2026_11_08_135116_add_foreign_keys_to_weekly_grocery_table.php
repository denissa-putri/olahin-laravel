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
        Schema::table('weekly_grocery', function (Blueprint $table) {
            $table->foreign(['id_user'], 'weekly_grocery_ibfk_1')->references(['id_user'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weekly_grocery', function (Blueprint $table) {
            $table->dropForeign('weekly_grocery_ibfk_1');
        });
    }
};
