<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\User\PengajuanController as UserPengajuanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\BantuanController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\PersyaratanController;
use App\Http\Controllers\Admin\SkpdController;
use App\Http\Controllers\Skpd\DashboardController as SkpdDashboardController;
use App\Http\Controllers\Skpd\PegawaiController as SkpdPegawaiController;
use App\Http\Controllers\Skpd\ProfilController as SkpdProfilController;
use App\Http\Controllers\Skpd\PengajuanController as SkpdPengajuanController;
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
    Route::delete('/pengajuan/{id}', [UserPengajuanController::class, 'destroy'])->name('user.pengajuan.destroy');
    Route::post('/pengajuan/{pengajuan}/kirim', [UserPengajuanController::class, 'kirim'])->name('user.pengajuan.kirim');
    
    Route::get('/profil', [ProfilController::class, 'index'])->name('user.profil.index');
    Route::put('/profil', [ProfilController::class, 'update'])->name('user.profil.update');
    Route::post('/profil/password', [ProfilController::class, 'changePassword'])->name('user.profil.password');
});

// SKPD Routes
Route::prefix('skpd')->middleware('auth')->group(function () {
    Route::get('/dashboard', [SkpdDashboardController::class, 'index'])->name('skpd.dashboard');
    
    Route::get('/pengajuan', function () {
        return view('skpd.pengajuan.index');
    })->name('skpd.pengajuan.index');
    
    Route::get('/pengajuan/create', [SkpdPengajuanController::class, 'create'])->name('skpd.pengajuan.create');
    Route::post('/pengajuan', [SkpdPengajuanController::class, 'store'])->name('skpd.pengajuan.store');
    
    Route::get('/pengajuan/{pengajuan}', function (\App\Models\Pengajuan $pengajuan) {
        // Get related data
        $persyaratans = $pengajuan->layanan ? $pengajuan->layanan->persyaratans : collect([]);
        $histories = $pengajuan->histories()->with('user')->orderBy('created_at', 'desc')->get();
        $revisions = $pengajuan->revisions()->orderBy('created_at', 'desc')->get();
        
        return view('skpd.pengajuan.show', compact('pengajuan', 'persyaratans', 'histories', 'revisions'));
    })->name('skpd.pengajuan.show');
    
    Route::post('/pengajuan/{pengajuan}/upload', [SkpdPengajuanController::class, 'uploadStore'])->name('skpd.pengajuan.upload.store');
    Route::post('/pengajuan/{pengajuan}/kirim', [SkpdPengajuanController::class, 'kirim'])->name('skpd.pengajuan.kirim');
    
    Route::get('/pegawai', [SkpdPegawaiController::class, 'index'])->name('skpd.pegawai.index');
    Route::get('/pegawai/create', [SkpdPegawaiController::class, 'create'])->name('skpd.pegawai.create');
    Route::post('/pegawai', [SkpdPegawaiController::class, 'store'])->name('skpd.pegawai.store');
    Route::get('/pegawai/{pegawai}', [SkpdPegawaiController::class, 'show'])->name('skpd.pegawai.show');
    Route::get('/pegawai/{pegawai}/edit', [SkpdPegawaiController::class, 'edit'])->name('skpd.pegawai.edit');
    Route::put('/pegawai/{pegawai}', [SkpdPegawaiController::class, 'update'])->name('skpd.pegawai.update');
    Route::delete('/pegawai/{pegawai}', [SkpdPegawaiController::class, 'destroy'])->name('skpd.pegawai.destroy');
    
    Route::get('/profil', [SkpdProfilController::class, 'index'])->name('skpd.profil.index');
    Route::put('/profil', [SkpdProfilController::class, 'update'])->name('skpd.profil.update');
    Route::post('/profil/password', [SkpdProfilController::class, 'changePassword'])->name('skpd.profil.password');
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
    Route::post('/pengajuan/{id}/proses-verifikasi', [PengajuanController::class, 'prosesVerifikasi'])->name('admin.pengajuan.prosesVerifikasi');
    Route::post('/pengajuan/{id}/revisi', [PengajuanController::class, 'requestRevision'])->name('admin.pengajuan.revisi');
    Route::post('/pengajuan/{id}/tolak', [PengajuanController::class, 'tolak'])->name('admin.pengajuan.tolak');
    Route::post('/pengajuan/{id}/upload-sk', [PengajuanController::class, 'uploadSk'])->name('admin.pengajuan.uploadSk');
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan.index');
    Route::get('/bantuan', [BantuanController::class, 'index'])->name('admin.bantuan.index');
    
    Route::get('/skpd', [SkpdController::class, 'index'])->name('admin.skpd.index');
    Route::get('/skpd/create', [SkpdController::class, 'create'])->name('admin.skpd.create');
    Route::post('/skpd', [SkpdController::class, 'store'])->name('admin.skpd.store');
    Route::get('/skpd/{skpd}', [SkpdController::class, 'show'])->name('admin.skpd.show');
    Route::get('/skpd/{skpd}/edit', [SkpdController::class, 'edit'])->name('admin.skpd.edit');
    Route::put('/skpd/{skpd}', [SkpdController::class, 'update'])->name('admin.skpd.update');
    Route::delete('/skpd/{skpd}', [SkpdController::class, 'destroy'])->name('admin.skpd.destroy');
    Route::post('/skpd/{skpd}/create-user', [SkpdController::class, 'createUser'])->name('admin.skpd.createUser');
    Route::post('/skpd/{skpd}/reset-password', [SkpdController::class, 'resetPassword'])->name('admin.skpd.resetPassword');
});
