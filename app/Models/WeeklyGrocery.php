<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyGrocery extends Model
{
    use HasFactory;

    protected $table = 'weekly_grocery';
    protected $primaryKey = 'id_grocery';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_barang',
        'kuantitas',
        'harga',
        'kategori',
        'hari',
        'minggu_ke',
        'bulan_tahun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

