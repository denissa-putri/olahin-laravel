<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBahan extends Model
{
    protected $table = 'master_bahan';
    protected $primaryKey = 'id_bahan';
    public $timestamps = false;
    protected $fillable = ['id_kategori', 'nama_bahan', 'satuan_terkecil', 'harga_estimasi'];

    public function kategori()
    {
        return $this->belongsTo(MasterKategori::class, 'id_kategori', 'id_kategori');
    }
}
