<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'kategori_mhs',
        'foto_profil',
        'deskripsi',
        'hobi',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Kompatibilitas dengan view Breeze yang memanggil ->name
    public function getNameAttribute(): ?string
    {
        return $this->username;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function stok()
    {
        return $this->hasMany(StokUser::class, 'id_user', 'id_user');
    }

    public function weeklyGroceries()
    {
        return $this->hasMany(WeeklyGrocery::class, 'id_user', 'id_user');
    }

    public function anggaran()
    {
        return $this->hasMany(AnggaranUser::class, 'id_user', 'id_user');
    }

    public function daftarBelanja()
    {
        return $this->hasMany(DaftarBelanja::class, 'id_user', 'id_user');
    }
}
