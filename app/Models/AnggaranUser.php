<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranUser extends Model
{
    use HasFactory;

    protected $table = 'anggaran_user';
    protected $primaryKey = 'id_anggaran';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'target_bulanan',
        'total_pengeluaran_aktual',
        'minggu_ke',
        'bulan_tahun',
        'kategori_terbanyak',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

