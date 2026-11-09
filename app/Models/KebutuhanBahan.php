<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KebutuhanBahan extends Model
{
    protected $table = 'kebutuhan_bahan_resep';
    protected $primaryKey = 'id_kebutuhan_bahan';
    public $timestamps = false;
    protected $fillable = [
        'id_resep',
        'id_bahan',
        'takaran',
        'satuan_bahan'
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep', 'id_resep');
    }
}
