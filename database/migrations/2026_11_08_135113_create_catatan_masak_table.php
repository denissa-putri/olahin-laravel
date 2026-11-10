<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catatan_masak', function (Blueprint $table) {
    
            $table->integer('id_catatan', true); 
            

            $table->integer('id_resep'); 
            
            $table->text('isi_catatan')->nullable(); 

        
            $table->foreign('id_resep')
                  ->references('id_resep')
                  ->on('master_resep')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catatan_masak');
    }
};