<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Modul Anggaran & Belanja (Farrel)
    Route::get('/anggaran', [AnggaranController::class, 'index'])->name('anggaran.index');
    Route::post('/anggaran/target', [AnggaranController::class, 'updateTarget'])->name('anggaran.target.update');
    Route::post('/anggaran/grocery', [AnggaranController::class, 'storeGrocery'])->name('anggaran.grocery.store');
    Route::put('/anggaran/grocery/{id}', [AnggaranController::class, 'updateGrocery'])->name('anggaran.grocery.update');
    Route::delete('/anggaran/grocery/{id}', [AnggaranController::class, 'destroyGrocery'])->name('anggaran.grocery.destroy');
});

require __DIR__.'/auth.php';
