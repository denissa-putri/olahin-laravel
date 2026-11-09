<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarBelanja extends Model
{
    use HasFactory;

    protected $table = 'daftar_belanja';
    protected $primaryKey = 'id_belanja';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_bahan',
        'jumlah_kurang',
        'status_beli',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function bahan()
    {
        return $this->belongsTo(MasterBahan::class, 'id_bahan', 'id_bahan');
    }
}

