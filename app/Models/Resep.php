<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'master_resep';
    protected $primaryKey = 'id_resep';
    public $timestamps = false;
    protected $fillable = [
        'id_user',
        'judul_resep',
        'instruksi_masak',
        'porsi'
    ];

    public function kebutuhanBahan()
    {
        return $this->hasMany(KebutuhanBahan::class, 'id_resep', 'id_resep');
    }
}
