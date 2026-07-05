<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PengajuanController as UserPengajuanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\BantuanController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\PersyaratanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [AuthController::class, 'redirectBasedOnRole'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes
Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    
    Route::get('/pengajuan', function () {
        return view('user.pengajuan.index');
    })->name('user.pengajuan.index');
    
    Route::get('/pengajuan/create', [UserPengajuanController::class, 'create'])->name('user.pengajuan.create');
    Route::post('/pengajuan', [UserPengajuanController::class, 'store'])->name('user.pengajuan.store');
    
    Route::get('/pengajuan/{pengajuan}/upload', [UserPengajuanController::class, 'upload'])->name('user.pengajuan.upload');
    Route::post('/pengajuan/{pengajuan}/upload', [UserPengajuanController::class, 'uploadStore'])->name('user.pengajuan.upload.store');
    
    Route::get('/pengajuan/{id}', [UserPengajuanController::class, 'show'])->name('user.pengajuan.show');
    
    Route::get('/profil', function () {
        return view('user.profil.index');
    })->name('user.profil.index');
});

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('admin.pegawai.index');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('admin.pegawai.create');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('admin.pegawai.store');
    Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show'])->name('admin.pegawai.show');
    Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('admin.pegawai.edit');
    Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('admin.pegawai.update');
    Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('admin.pegawai.destroy');
    Route::post('/pegawai/{pegawai}/create-user', [PegawaiController::class, 'createUser'])->name('admin.pegawai.createUser');
    Route::post('/pegawai/{pegawai}/reset-password', [PegawaiController::class, 'resetPassword'])->name('admin.pegawai.resetPassword');
    Route::get('/layanan', [LayananController::class, 'index'])->name('admin.layanan.index');
    Route::get('/layanan/create', [LayananController::class, 'create'])->name('admin.layanan.create');
    Route::post('/layanan', [LayananController::class, 'store'])->name('admin.layanan.store');
    Route::get('/layanan/{layanan}', [LayananController::class, 'show'])->name('admin.layanan.show');
    Route::get('/layanan/{layanan}/edit', [LayananController::class, 'edit'])->name('admin.layanan.edit');
    Route::put('/layanan/{layanan}', [LayananController::class, 'update'])->name('admin.layanan.update');
    Route::delete('/layanan/{layanan}', [LayananController::class, 'destroy'])->name('admin.layanan.destroy');
    Route::post('/layanan/{layanan}/toggle-status', [LayananController::class, 'toggleStatus'])->name('admin.layanan.toggleStatus');
    
    Route::get('/layanan/{layanan}/persyaratan', [PersyaratanController::class, 'index'])->name('admin.persyaratan.index');
    Route::get('/layanan/{layanan}/persyaratan/create', [PersyaratanController::class, 'create'])->name('admin.persyaratan.create');
    Route::post('/layanan/{layanan}/persyaratan', [PersyaratanController::class, 'store'])->name('admin.persyaratan.store');
    Route::get('/layanan/{layanan}/persyaratan/{persyaratan}/edit', [PersyaratanController::class, 'edit'])->name('admin.persyaratan.edit');
    Route::put('/layanan/{layanan}/persyaratan/{persyaratan}', [PersyaratanController::class, 'update'])->name('admin.persyaratan.update');
    Route::delete('/layanan/{layanan}/persyaratan/{persyaratan}', [PersyaratanController::class, 'destroy'])->name('admin.persyaratan.destroy');
    
    Route::get('/penduduk', [PendudukController::class, 'index'])->name('admin.penduduk.index');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan.index');
    Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])->name('admin.pengajuan.show');
    Route::post('/pengajuan/{id}/status', [PengajuanController::class, 'updateStatus'])->name('admin.pengajuan.updateStatus');
    Route::post('/pengajuan/{id}/verifikasi', [PengajuanController::class, 'verifikasi'])->name('admin.pengajuan.verifikasi');
    Route::post('/pengajuan/{id}/revisi', [PengajuanController::class, 'requestRevision'])->name('admin.pengajuan.revisi');
    Route::post('/pengajuan/{id}/tolak', [PengajuanController::class, 'tolak'])->name('admin.pengajuan.tolak');
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan.index');
    Route::get('/bantuan', [BantuanController::class, 'index'])->name('admin.bantuan.index');
});
