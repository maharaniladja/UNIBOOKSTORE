<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoBukuController;

// Halaman Beranda
Route::get('/', [TokoBukuController::class, 'home'])->name('home');

// Halaman Admin
Route::get('/admin', [TokoBukuController::class, 'admin'])->name('admin.index');

// Route Admin - Buku
Route::get('/admin/buku/create', [TokoBukuController::class, 'createBuku'])->name('admin.buku.create');
Route::get('/admin/buku/{id}/edit', [TokoBukuController::class, 'editBuku'])->name('admin.buku.edit');
Route::post('/admin/buku/store', [TokoBukuController::class, 'storeBuku'])->name('admin.buku.store');
Route::delete('/admin/buku/{id}', [TokoBukuController::class, 'destroyBuku'])->name('admin.buku.destroy');

// Route Admin - Penerbit
Route::get('/admin/penerbit/create', [TokoBukuController::class, 'createPenerbit'])->name('admin.penerbit.create');
Route::get('/admin/penerbit/{id}/edit', [TokoBukuController::class, 'editPenerbit'])->name('admin.penerbit.edit');
Route::post('/admin/penerbit/store', [TokoBukuController::class, 'storePenerbit'])->name('admin.penerbit.store');
Route::delete('/admin/penerbit/{id}', [TokoBukuController::class, 'destroyPenerbit'])->name('admin.penerbit.destroy');

// Halaman Pengadaan
Route::get('/pengadaan', [TokoBukuController::class, 'pengadaan'])->name('pengadaan');