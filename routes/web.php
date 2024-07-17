<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//peminjaman
Route::get('/dashboard', function () {
    return redirect('/peminjaman');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->middleware(['auth', 'verified'])->name('peminjaman');
Route::post('/peminjaman-store', [PeminjamanController::class, 'store'])->middleware(['auth', 'verified'])->name('peminjaman.store');
Route::put('/peminjaman-update/{id}', [PeminjamanController::class, 'update'])->middleware(['auth', 'verified'])->name('peminjaman.update');

Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('peminjaman.destroy');

//buku
Route::get('/buku', [ BukuController::class, 'index']
)->middleware(['auth', 'verified'])->name('buku');
Route::post('/buku-store', [ BukuController::class, 'store']
)->middleware(['auth', 'verified'])->name('buku.store');
Route::put('/buku-update/{id}', [BukuController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('buku.update');
Route::delete('/buku-delete/{id}', [BukuController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('buku.destroy');

//mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index']
)->middleware(['auth', 'verified'])->name('mahasiswa');
Route::delete('/mahasiswa-delete/{id}', [MahasiswaController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('mahasiswa.destroy');
Route::put('/mahasiswa-update/{id}', [MahasiswaController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('mahasiswa.update');
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('mahasiswa.store');

//pengembalian
Route::get('/pengembalian', [PengembalianController::class, 'index'])->middleware(['auth', 'verified'])->name('pengembalian');
Route::post('/pengembalian-store', [PengembalianController::class, 'store'])->middleware(['auth', 'verified'])->name('pengembalian.store');
Route::put('/pengembalian-update/{id}', [PengembalianController::class, 'update'])->middleware(['auth', 'verified'])->name('pengembalian.update');
Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('pengembalian.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
