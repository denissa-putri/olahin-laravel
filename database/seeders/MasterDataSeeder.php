<?php

namespace Database\Seeders;

use App\Models\MasterBahan;
use App\Models\MasterKategori;
use App\Models\StokUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@olahin.test'],
            ['username' => 'admin', 'password' => Hash::make('password'), 'role' => 'admin']
        );
        $user = User::updateOrCreate(
            ['email' => 'user@olahin.test'],
            ['username' => 'userdemo', 'password' => Hash::make('password'), 'role' => 'user']
        );

        $sayur = MasterKategori::firstOrCreate(['nama_kategori' => 'Sayur']);
        $protein = MasterKategori::firstOrCreate(['nama_kategori' => 'Protein']);
        $bumbu = MasterKategori::firstOrCreate(['nama_kategori' => 'Bumbu']);

        $bayam = MasterBahan::firstOrCreate(
            ['nama_bahan' => 'Bayam'],
            ['id_kategori' => $sayur->id_kategori, 'satuan_terkecil' => 'ikat', 'harga_estimasi' => 3000]
        );
        $telur = MasterBahan::firstOrCreate(
            ['nama_bahan' => 'Telur'],
            ['id_kategori' => $protein->id_kategori, 'satuan_terkecil' => 'butir', 'harga_estimasi' => 2000]
        );
        $bawang = MasterBahan::firstOrCreate(
            ['nama_bahan' => 'Bawang Merah'],
            ['id_kategori' => $bumbu->id_kategori, 'satuan_terkecil' => 'kg', 'harga_estimasi' => 35000]
        );

        StokUser::firstOrCreate(
            ['id_user' => $user->id_user, 'id_bahan' => $telur->id_bahan],
            ['kuantitas' => '6 butir', 'tanggal_kadaluarsa' => now()->addDays(2)->toDateString()]
        );
        StokUser::firstOrCreate(
            ['id_user' => $user->id_user, 'id_bahan' => $bayam->id_bahan],
            ['kuantitas' => '2 ikat', 'tanggal_kadaluarsa' => now()->subDay()->toDateString()]
        );
        StokUser::firstOrCreate(
            ['id_user' => $user->id_user, 'nama_bahan_custom' => 'Sambal Botol'],
            ['id_bahan' => null, 'kuantitas' => '1 botol', 'tanggal_kadaluarsa' => now()->addDays(10)->toDateString()]
        );
    }
}
