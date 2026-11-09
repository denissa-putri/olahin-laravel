<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanMasak extends Model
{
    protected $table = 'catatan_masak';
    protected $primaryKey = 'id_catatan'; 
    public $timestamps = false;
    
    protected $fillable = ['id_resep', 'isi_catatan']; 

    public function resep() {
        return $this->belongsTo(Resep::class, 'id_resep', 'id_resep');
    }
}
