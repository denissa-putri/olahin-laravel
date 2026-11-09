<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MasterKategori extends Model
{
    protected $table = 'master_kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;
    protected $fillable = ['nama_kategori'];

    public function bahan()
    {
        return $this->hasMany(MasterBahan::class, 'id_kategori', 'id_kategori');
    }
}
