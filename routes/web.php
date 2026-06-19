<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FrontendAuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BannerController;

// ==========================================
// 1. ROUTE PUBLIC (TIDAK PERLU LOGIN)
// ==========================================

// Halaman Utama & Detail
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/produk/{id}', [FrontendController::class, 'detail'])->name('frontend.detail');

// Checkout (Guest / Belum Login bisa akses)
Route::post('/checkout', [FrontendController::class, 'checkout'])->name('frontend.checkout');
Route::post('/proses-beli', [FrontendController::class, 'prosesBeli'])->name('frontend.proses_beli');

// Auth Frontend (Pembeli)
Route::get('/login', [FrontendAuthController::class, 'login'])->name('login');
Route::post('/login', [FrontendAuthController::class, 'authenticate'])->name('login.post');
Route::get('/register', [FrontendAuthController::class, 'register'])->name('register');
Route::post('/register', [FrontendAuthController::class, 'store'])->name('register.post');

// Auth Backend (Halaman Login Admin)
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend']);


// ==========================================
// 2. ROUTE CUSTOMER / MEMBER (WAJIB LOGIN)
// ==========================================
Route::middleware(['auth'])->group(function () {

  // Logout Frontend
  Route::post('/logout', [FrontendAuthController::class, 'logout'])->name('logout');

  // Profil
  Route::get('/profil', [FrontendController::class, 'profile'])->name('frontend.profile');
  Route::put('/profil', [FrontendController::class, 'updateProfile'])->name('frontend.profile.update');

  // Riwayat Pembelian
  Route::get('/riwayat-pembelian', [FrontendController::class, 'riwayat'])->name('frontend.riwayat');
});


// ==========================================
// 3. ROUTE ADMIN (WAJIB LOGIN + ROLE 0 atau 1)
// ==========================================
Route::middleware(['auth', IsAdmin::class])->group(function () {

  // Logout & Beranda Backend
  Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');
  Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda');

  // Transaksi
  Route::get('backend/transaksi', [TransaksiController::class, 'index'])->name('backend.transaksi.index');
  Route::put('backend/transaksi/{id}/status', [TransaksiController::class, 'updateStatus'])->name('backend.transaksi.update_status');

  // User & Laporan User
  Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser');
  Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser');
  Route::resource('backend/user', UserController::class, ['as' => 'backend']);

  // Kategori
  Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend']);

  // Produk, Foto, & Laporan Produk
  Route::get('backend/laporan/formproduk', [ProdukController::class, 'formProduk'])->name('backend.laporan.formproduk');
  Route::post('backend/laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('backend.laporan.cetakproduk');
  Route::post('foto-produk/store', [ProdukController::class, 'storeFoto'])->name('backend.foto_produk.store');
  Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('backend.foto_produk.destroy');
  Route::resource('backend/produk', ProdukController::class, ['as' => 'backend']);

  // banner
  Route::resource('backend/banner', BannerController::class)->except(['show', 'edit', 'update'])->names([
    'index' => 'backend.banner.index',
    'create' => 'backend.banner.create',
    'store' => 'backend.banner.store',
    'destroy' => 'backend.banner.destroy',
  ]);
});
