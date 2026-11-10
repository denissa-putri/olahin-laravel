<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterBahanController;
use App\Http\Controllers\MasterKategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\StokUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('master-kategori', MasterKategoriController::class)->except(['show'])->parameters([
        'master-kategori' => 'master_kategori',
    ]);
    Route::resource('master-bahan', MasterBahanController::class)->except(['show'])->parameters([
        'master-bahan' => 'master_bahan',
    ]);
    Route::resource('stok', StokUserController::class)->except(['show'])->parameters([
        'stok' => 'stok',
    ]);
    Route::resource('resep', ResepController::class);

    // Modul Anggaran & Belanja (Farrel)
    Route::get('/anggaran', [AnggaranController::class, 'index'])->name('anggaran.index');
    Route::post('/anggaran/target', [AnggaranController::class, 'updateTarget'])->name('anggaran.target.update');
    Route::post('/anggaran/grocery', [AnggaranController::class, 'storeGrocery'])->name('anggaran.grocery.store');
    Route::put('/anggaran/grocery/{id}', [AnggaranController::class, 'updateGrocery'])->name('anggaran.grocery.update');
    Route::delete('/anggaran/grocery/{id}', [AnggaranController::class, 'destroyGrocery'])->name('anggaran.grocery.destroy');
});

require __DIR__.'/auth.php';
