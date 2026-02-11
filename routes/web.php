<?php

use App\Http\Controllers\UtamaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CostomerController;
use App\Http\Controllers\MetodepembayaranController;
use App\Http\Controllers\TalentRegistrationController;

Route::get('/', [UtamaController::class, 'index']);
Route::get('/login', [UtamaController::class, 'index2']);
Route::post('/login/admin', [UtamaController::class, 'dologin']);
Route::get('/logout', [UtamaController::class, 'logout'])->middleware('cekuser');
Route::post('/utama/komentar', [UtamaController::class, 'store']);
Route::get('/pricelist', [UtamaController::class, 'pricelist']);
Route::get('/payment', [UtamaController::class, 'payment']);

// Talent Registration Routes
Route::get('/talent/register', [TalentRegistrationController::class, 'create'])->name('talent.register');
Route::post('/talent/register', [TalentRegistrationController::class, 'store'])->name('talent.register.store');

// Admin Talent Dashboard Routes
Route::middleware('cekuser')->prefix('dashboard')->group(function () {
    Route::get('/talent', [TalentRegistrationController::class, 'index'])->name('admin.talent.index');
    Route::get('/talent/{id}', [TalentRegistrationController::class, 'show'])->name('admin.talent.show');
    Route::get('/talent/{id}/file', [TalentRegistrationController::class, 'viewFile'])->name('admin.talent.file');
    Route::put('/talent/{id}/status', [TalentRegistrationController::class, 'updateStatus'])->name('admin.talent.updateStatus');
    Route::delete('/talent/{id}', [TalentRegistrationController::class, 'destroy'])->name('admin.talent.destroy');
});

Route::get('/dashboard', [AdminController::class, 'index'])->middleware('cekuser');
Route::get('/dashboard2', [AdminController::class, 'index2'])->middleware('cekuser');
Route::get('/dashboard/komentar', [AdminController::class, 'komentar'])->middleware('cekuser');
Route::get('/dashboard/{id_komentar}/edit', [AdminController::class, 'edit'])->middleware('cekuser');
Route::put('/dashboard/{id_komentar}', [AdminController::class, 'update'])->middleware('cekuser');
Route::delete('/komentar/{id_komentar}', [AdminController::class, 'delete'])->middleware('cekuser');

Route::get('/dashboard/costomer', [CostomerController::class, 'index'])->middleware('cekuser');
Route::put('selesaikan/{id_costomer}', [CostomerController::class, 'update'])->middleware('cekuser');
Route::get('dashboard/costomer/tambah', [CostomerController::class, 'tambah'])->middleware('cekuser');
Route::post('dashboard/costomer/tambah/data', [CostomerController::class, 'store'])->middleware('cekuser');
Route::get('/costomer/{id_costomer}/edit', [CostomerController::class, 'edit'])->middleware('cekuser');
Route::get('/costomer/{id_costomer}/nota', [CostomerController::class, 'nota'])->middleware('cekuser');
Route::put('/update/data/{id_costomer}', [CostomerController::class, 'updatedata'])->middleware('cekuser');
Route::delete('/hapus/{id_costomer}', [CostomerController::class, 'delete'])->middleware('cekuser');
Route::post('/tambah/harga/{id_costomer}', [CostomerController::class, 'tambah_nota'])->middleware('cekuser');

Route::delete('costomer/{id_costomer}/hapus/harga/{id_nota}', [CostomerController::class, 'hapus_harga'])->middleware('cekuser');


Route::get('/metodepembayaran', [MetodepembayaranController::class, 'index'])->middleware('cekuser');
Route::get('/metodepembayaran/tambah', [MetodepembayaranController::class, 'tambah'])->middleware('cekuser');
Route::post('/metodepembayaran/tambah/data', [MetodepembayaranController::class, 'store'])->middleware('cekuser');
Route::get('/metode/{id_metode}/edit', [MetodepembayaranController::class, 'edit'])->middleware('cekuser');
Route::put('/metode/edit/{id_metode}', [MetodepembayaranController::class, 'update'])->middleware('cekuser');
Route::delete('/metode/delete/{id_metode}', [MetodepembayaranController::class, 'delete'])->middleware('cekuser');


Route::get('/belum', [CostomerController::class, 'index2'])->middleware('cekuser');



