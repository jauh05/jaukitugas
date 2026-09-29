<?php

use App\Http\Controllers\UtamaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CostomerController;
use App\Http\Controllers\MetodepembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TalentRegistrationController;
use App\Http\Controllers\OfficeAuthController;
use App\Http\Controllers\LivingOfficeController;

Route::get('/', [UtamaController::class, 'index']);
Route::get('/office/login', [OfficeAuthController::class, 'showLogin'])->name('login');
Route::post('/office/login', [OfficeAuthController::class, 'login']);
Route::post('/office/logout', [OfficeAuthController::class, 'logout'])->name('office.logout');

Route::middleware(['auth', 'office.owner'])->prefix('office')->group(function () {
    Route::get('/', fn () => view('living-office'))->name('office.index');
    Route::prefix('api')->group(function () {
        Route::get('/agents', [LivingOfficeController::class, 'getAgents']);
        Route::get('/agents/{id}', [LivingOfficeController::class, 'getAgent']);
        Route::get('/tasks', [LivingOfficeController::class, 'getTasks']);
        Route::get('/activity', [LivingOfficeController::class, 'getActivity']);
        Route::get('/content', [LivingOfficeController::class, 'getContent']);
        Route::get('/summary', [LivingOfficeController::class, 'summary']);
        Route::get('/notifications', [LivingOfficeController::class, 'getNotifications']);
        Route::patch('/notifications/read-all', [LivingOfficeController::class, 'readAllNotifications']);
        Route::patch('/notifications/{notification}/read', [LivingOfficeController::class, 'readNotification']);
        Route::get('/commands', [LivingOfficeController::class, 'getCommands']);
        Route::get('/system-status', [LivingOfficeController::class, 'getSystemStatus']);
        Route::post('/agents/{id}/command', [LivingOfficeController::class, 'commandAgent']);
    });
});
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
    Route::post('/costomer/bulk-update', [CostomerController::class, 'bulkUpdateStatus'])->name('costomer.bulkUpdate');
});

Route::get('/dashboard', [AdminController::class, 'index'])->middleware('cekuser');
Route::get('/dashboard2', [AdminController::class, 'index2'])->middleware('cekuser');
Route::get('/dashboard/komentar', [AdminController::class, 'komentar'])->middleware('cekuser');
Route::get('/dashboard/{id_komentar}/edit', [AdminController::class, 'edit'])->middleware('cekuser');
Route::put('/dashboard/{id_komentar}', [AdminController::class, 'update'])->middleware('cekuser');
Route::delete('/komentar/{id_komentar}', [AdminController::class, 'delete'])->middleware('cekuser');

Route::middleware('cekuser')->prefix('dashboard')->group(function () {
    Route::get('/costomer', [CostomerController::class, 'index'])->name('costomer.index');
    Route::get('/costomer/tambah', [CostomerController::class, 'tambah'])->name('costomer.tambah');
    Route::get('/jadwal', [CostomerController::class, 'jadwal'])->name('costomer.jadwal');
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
});

Route::put('selesaikan/{id_costomer}', [CostomerController::class, 'update'])->middleware('cekuser');
Route::put('dashboard/costomer/{id_costomer}/board', [CostomerController::class, 'updateBoard'])->middleware('cekuser')->name('costomer.board.update');
Route::post('dashboard/costomer/tambah/data', [CostomerController::class, 'store'])->middleware('cekuser');
Route::post('dashboard/jadwal/{id_costomer}/nota', [CostomerController::class, 'tambahNotaJadwal'])->middleware('cekuser')->name('jadwal.nota.store');
Route::get('/costomer/{id_costomer}/edit', [CostomerController::class, 'edit'])->middleware('cekuser');
Route::get('/costomer/{id_costomer}/nota', [CostomerController::class, 'nota'])->middleware('cekuser');
Route::put('/update/data/{id_costomer}', [CostomerController::class, 'updatedata'])->middleware('cekuser');
Route::delete('/hapus/{id_costomer}', [CostomerController::class, 'delete'])->middleware('cekuser');
Route::post('/tambah/harga/{id_costomer}', [CostomerController::class, 'tambah_nota'])->middleware('cekuser');
Route::post('/update/diskon/{id_costomer}', [CostomerController::class, 'update_diskon'])->middleware('cekuser')->name('update.diskon');

Route::delete('costomer/{id_costomer}/hapus/harga/{id_nota}', [CostomerController::class, 'hapus_harga'])->middleware('cekuser');
Route::post('dashboard/pengeluaran/tambah', [PengeluaranController::class, 'store'])->middleware('cekuser')->name('pengeluaran.store');
Route::put('dashboard/pengeluaran/{id_pengeluaran}', [PengeluaranController::class, 'update'])->middleware('cekuser')->name('pengeluaran.update');
Route::delete('dashboard/pengeluaran/{id_pengeluaran}', [PengeluaranController::class, 'delete'])->middleware('cekuser')->name('pengeluaran.delete');


Route::get('/metodepembayaran', [MetodepembayaranController::class, 'index'])->middleware('cekuser');
Route::get('/metodepembayaran/tambah', [MetodepembayaranController::class, 'tambah'])->middleware('cekuser');
Route::post('/metodepembayaran/tambah/data', [MetodepembayaranController::class, 'store'])->middleware('cekuser');
Route::get('/metode/{id_metode}/edit', [MetodepembayaranController::class, 'edit'])->middleware('cekuser');
Route::put('/metode/edit/{id_metode}', [MetodepembayaranController::class, 'update'])->middleware('cekuser');
Route::delete('/metode/delete/{id_metode}', [MetodepembayaranController::class, 'delete'])->middleware('cekuser');


Route::get('/belum', [CostomerController::class, 'index2'])->middleware('cekuser');




// Public Article Routes
Route::get('/artikel', [\App\Http\Controllers\PublicArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [\App\Http\Controllers\PublicArticleController::class, 'show'])->name('artikel.show');

// Admin Article Routes
Route::middleware('cekuser')->prefix('dashboard')->group(function () {
    Route::resource('articles', \App\Http\Controllers\AdminArticleController::class)->names('admin.articles');
});

// Sitemap
Route::get('/sitemap.xml', function () {
    $articles = \App\Models\Article::published()->latest('updated_at')->get();
    
    return response()->view('sitemap', [
        'articles' => $articles
    ])->header('Content-Type', 'text/xml');
});
