<?php

namespace App\Http\Controllers;

use App\Models\AnggaranUser;
use App\Models\WeeklyGrocery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggaranController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $bulanTahun = $request->query('bulan_tahun', date('Y-m'));
        $mingguKe = (int) $request->query('minggu_ke', 1);

        // Ambil atau inisialisasi anggaran bulanan user
        $anggaran = AnggaranUser::firstOrCreate(
            [
                'id_user' => $userId,
                'bulan_tahun' => $bulanTahun,
            ],
            [
                'target_bulanan' => 1000000,
                'total_pengeluaran_aktual' => 0,
                'minggu_ke' => $mingguKe,
                'kategori_terbanyak' => 'Grocery',
            ]
        );

        // Hitung total pengeluaran aktual bulan ini dari seluruh weekly grocery bulan ini
        $totalPengeluaranBulan = WeeklyGrocery::where('id_user', $userId)
            ->where('bulan_tahun', $bulanTahun)
            ->sum('harga');

        // Update total pengeluaran aktual jika berbeda
        if ($anggaran->total_pengeluaran_aktual != $totalPengeluaranBulan) {
            $anggaran->total_pengeluaran_aktual = $totalPengeluaranBulan;
            $anggaran->save();
        }

        // Hitung pengeluaran per minggu (Minggu 1, 2, 3, 4) untuk bar chart
        $chartMingguan = [];
        for ($m = 1; $m <= 4; $m++) {
            $sumMinggu = WeeklyGrocery::where('id_user', $userId)
                ->where('bulan_tahun', $bulanTahun)
                ->where('minggu_ke', $m)
                ->sum('harga');
            $chartMingguan[$m] = (int) $sumMinggu;
        }

        // Ambil data belanjaan mingguan berdasarkan minggu yang dipilih
        $groceries = WeeklyGrocery::where('id_user', $userId)
            ->where('bulan_tahun', $bulanTahun)
            ->where('minggu_ke', $mingguKe)
            ->get();

        // Kelompokkan belanjaan berdasarkan hari (Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Minggu)
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $groceriesByHari = [];
        foreach ($hariList as $hari) {
            $groceriesByHari[$hari] = $groceries->where('hari', $hari);
        }

        $sisaAnggaran = max(0, $anggaran->target_bulanan - $totalPengeluaranBulan);
        $persenTerpakai = $anggaran->target_bulanan > 0
            ? min(100, round(($totalPengeluaranBulan / $anggaran->target_bulanan) * 100))
            : 0;

        return view('anggaran.index', compact(
            'anggaran',
            'bulanTahun',
            'mingguKe',
            'chartMingguan',
            'groceriesByHari',
            'sisaAnggaran',
            'persenTerpakai',
            'hariList'
        ));
    }

    public function updateTarget(Request $request)
    {
        $request->validate([
            'target_bulanan' => 'required|numeric|min:0',
            'bulan_tahun' => 'required|string',
        ]);

        $userId = Auth::id();
        $anggaran = AnggaranUser::where('id_user', $userId)
            ->where('bulan_tahun', $request->bulan_tahun)
            ->first();

        if ($anggaran) {
            $anggaran->update([
                'target_bulanan' => $request->target_bulanan,
            ]);
        } else {
            AnggaranUser::create([
                'id_user' => $userId,
                'bulan_tahun' => $request->bulan_tahun,
                'target_bulanan' => $request->target_bulanan,
                'total_pengeluaran_aktual' => 0,
                'minggu_ke' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Target anggaran berhasil diperbarui.');
    }

    public function storeGrocery(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:150',
            'jumlah' => 'required|numeric|min:0.01',
            'satuan' => 'required|string|max:20',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'nullable|string|max:100',
            'hari' => 'required|string|max:20',
            'minggu_ke' => 'required|integer|between:1,5',
            'bulan_tahun' => 'required|string|max:7',
        ]);

        $kuantitas = $validated['jumlah'] . ' ' . $validated['satuan'];

        WeeklyGrocery::create([
            'id_user' => Auth::id(),
            'nama_barang' => $validated['nama_barang'],
            'kuantitas' => $kuantitas,
            'harga' => $validated['harga'],
            'kategori' => $validated['kategori'] ?? 'Grocery',
            'hari' => $validated['hari'],
            'minggu_ke' => $validated['minggu_ke'],
            'bulan_tahun' => $validated['bulan_tahun'],
        ]);

        return redirect()->back()->with('success', 'Bahan belanjaan berhasil ditambahkan!');
    }

    public function updateGrocery(Request $request, $id)
    {
        $grocery = WeeklyGrocery::where('id_user', Auth::id())
            ->where('id_grocery', $id)
            ->firstOrFail();

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:150',
            'jumlah' => 'required|numeric|min:0.01',
            'satuan' => 'required|string|max:20',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'nullable|string|max:100',
            'hari' => 'required|string|max:20',
        ]);

        $kuantitas = $validated['jumlah'] . ' ' . $validated['satuan'];

        $grocery->update([
            'nama_barang' => $validated['nama_barang'],
            'kuantitas' => $kuantitas,
            'harga' => $validated['harga'],
            'kategori' => $validated['kategori'] ?? $grocery->kategori,
            'hari' => $validated['hari'],
        ]);

        return redirect()->back()->with('success', 'Bahan belanjaan berhasil diubah!');
    }

    public function destroyGrocery($id)
    {
        $grocery = WeeklyGrocery::where('id_user', Auth::id())
            ->where('id_grocery', $id)
            ->firstOrFail();

        $grocery->delete();

        return redirect()->back()->with('success', 'Bahan belanjaan berhasil dihapus.');
    }
}

