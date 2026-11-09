<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokUser extends Model
{
    protected $table = 'stok_user';
    protected $primaryKey = 'id_stok';
    public $timestamps = false;
    protected $fillable = [
        'id_user',
        'id_bahan',
        'nama_bahan_custom',
        'kategori_custom',
        'kuantitas',
        'tanggal_kadaluarsa',
    ];

    protected $casts = [
        'tanggal_kadaluarsa' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function bahan()
    {
        return $this->belongsTo(MasterBahan::class, 'id_bahan', 'id_bahan');
    }

    public function getNamaTampilAttribute(): string
    {
        return $this->bahan->nama_bahan ?? $this->nama_bahan_custom ?? '-';
    }

    public function getStatusKadaluarsaAttribute(): string
    {
        $exp = $this->tanggal_kadaluarsa;
        if (!$exp) return 'AMAN';
        if ($exp->isPast()) return 'EXPIRED';
        if ($exp->diffInDays(now()) <= 3) return 'MENIPIS';
        return 'AMAN';
    }

    public function scopeMilikUser($q, $userId)
    {
        return $q->where('id_user', $userId);
    }

    public function scopeExpired($q)
    {
        return $q->whereDate('tanggal_kadaluarsa', '<', now()->toDateString());
    }

    public function scopeMenipis($q, $days = 3)
    {
        return $q->whereNotNull('tanggal_kadaluarsa')
                 ->whereDate('tanggal_kadaluarsa', '>=', now()->toDateString())
                 ->whereDate('tanggal_kadaluarsa', '<=', now()->addDays($days)->toDateString());
    }
}
