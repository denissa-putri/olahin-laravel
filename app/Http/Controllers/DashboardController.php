<?php

namespace App\Http\Controllers;

use App\Models\AnggaranUser;
use App\Models\Resep;
use App\Models\StokUser;
use App\Models\WeeklyGrocery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $bulanTahun = date('Y-m');

        // 1. Data Anggaran Makananmu (Card Kiri)
        $anggaran = AnggaranUser::firstOrCreate(
            [
                'id_user' => $userId,
                'bulan_tahun' => $bulanTahun,
            ],
            [
                'target_bulanan' => 1000000,
                'total_pengeluaran_aktual' => 0,
                'minggu_ke' => 1,
                'kategori_terbanyak' => 'Grocery',
            ]
        );

        // Hitung total pengeluaran aktual dari weekly grocery
        $totalPengeluaran = WeeklyGrocery::where('id_user', $userId)
            ->where('bulan_tahun', $bulanTahun)
            ->sum('harga');

        if ($anggaran->total_pengeluaran_aktual != $totalPengeluaran) {
            $anggaran->total_pengeluaran_aktual = $totalPengeluaran;
            $anggaran->save();
        }

        $sisaAnggaran = max(0, $anggaran->target_bulanan - $totalPengeluaran);
        $persenTerpakai = $anggaran->target_bulanan > 0
            ? min(100, round(($totalPengeluaran / $anggaran->target_bulanan) * 100))
            : 0;

        // 2. Data Riwayat Bahan yang Dibeli (Card Kanan)
        // Cek data dari WeeklyGrocery user
        $riwayatKategori = WeeklyGrocery::where('id_user', $userId)
            ->select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        // 3. Resep Trending (Data nyata dari tabel master_resep jika ada, atau rekomendasi kurasi default)
        $resepTrending = Resep::limit(3)->get();
        if ($resepTrending->isEmpty()) {
            $resepTrending = collect([
                (object)[
                    'id_resep' => null,
                    'judul_resep' => 'Mie Goreng',
                    'gambar_url' => 'https://images.unsplash.com/photo-1612927601601-6638404737ce?auto=format&fit=crop&w=600&q=80',
                    'instruksi_masak' => 'Mie lembut dengan sayuran yang melimpah.',
                    'waktu_memasak' => 15,
                    'kesulitan' => 'Mudah',
                    'porsi' => 2,
                    'rating' => 4.8,
                    'tag' => 'Karbohidrat'
                ],
                (object)[
                    'id_resep' => null,
                    'judul_resep' => 'Ayam Geprek',
                    'gambar_url' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&w=600&q=80',
                    'instruksi_masak' => 'Ayam yang dipukul gurih berpadu sambal bawang pedas.',
                    'waktu_memasak' => 30,
                    'kesulitan' => 'Mudah',
                    'porsi' => 2,
                    'rating' => 4.9,
                    'tag' => 'Karbohidrat'
                ],
                (object)[
                    'id_resep' => null,
                    'judul_resep' => 'Pancake Raspberry',
                    'gambar_url' => 'https://images.unsplash.com/photo-1528207776546-365bb710ee93?auto=format&fit=crop&w=600&q=80',
                    'instruksi_masak' => 'Pancake dengan raspberry yang cream dipadu dengan madu yang manis.',
                    'waktu_memasak' => 15,
                    'kesulitan' => 'Mudah',
                    'porsi' => 1,
                    'rating' => 4.6,
                    'tag' => 'Dessert'
                ],
            ]);
        }

        // 4. Berita Terkini (Data dari tabel berita_trending jika ada, atau berita pangan terkini)
        $beritaTerkini = DB::table('berita_trending')->limit(3)->get();
        if ($beritaTerkini->isEmpty()) {
            $beritaTerkini = collect([
                (object)[
                    'judul' => 'Fluktuatif, Harga Cabai Rawit dari 65 Ribu ke 75 Ribu, Kini Turun 70 rb - Gema Surya FM',
                    'gambar_url' => 'https://images.unsplash.com/photo-1588252303782-cb80119abd6d?auto=format&fit=crop&w=600&q=80',
                    'link_tujuan' => '#',
                ],
                (object)[
                    'judul' => 'Permintaan melonjak menjadi penyebab bawang merah naik harga!',
                    'gambar_url' => 'https://images.unsplash.com/photo-1618512496248-a07fe83aa8cb?auto=format&fit=crop&w=600&q=80',
                    'link_tujuan' => '#',
                ],
                (object)[
                    'judul' => 'Harga beras naik terus, pakar ekonomi beri komentar ini',
                    'gambar_url' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=600&q=80',
                    'link_tujuan' => '#',
                ],
            ]);
        }

        // 5. Data ringkasan stok pengguna (integrasi modul Denissa)
        $expired = StokUser::milikUser($userId)->expired()->count();
        $menipis = StokUser::milikUser($userId)->menipis(3)->count();
        $totalStok = StokUser::milikUser($userId)->count();

        return view('dashboard', compact(
            'anggaran',
            'sisaAnggaran',
            'persenTerpakai',
            'riwayatKategori',
            'resepTrending',
            'beritaTerkini',
            'expired',
            'menipis',
            'totalStok'
        ));
    }
}

