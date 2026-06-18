<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RestoController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\WisatawanController;
use App\Http\Controllers\PublicController;

// =====================
// AUTH ROUTES (Guest)
// =====================
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'proses'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])
    ->name('wisatawan.register');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('wisatawan.register.store');

Route::get('/register/restoran', function () {
    return view('Wisatawan.formulirPendaftaranUsaha');
})->name('restoran.register');

Route::post('/register/restoran', [RegisterController::class, 'mitraStore'])
    ->name('restoran.register.store');

Route::get('/forgot-password', function () {
    return view('Wisatawan.login'); // TODO: create dedicated forgot-password view
})->name('password.request');

// =====================
// PUBLIC ROUTES (No Auth Required)
// =====================
Route::get('/homepage', [WisatawanController::class, 'guestHomepage'])->name('homepage');

Route::get('/tentang-kami', [PublicController::class, 'tentang'])->name('tentang.kami');
Route::get('/kebijakan-privasi', [PublicController::class, 'privacy'])->name('kebijakan.privasi');
Route::get('/pusat-bantuan', [PublicController::class, 'help'])->name('pusat.bantuan');

// Aliases for broken links in views
Route::get('/privacy-policy-alias', [PublicController::class, 'privacy'])->name('privacy-policy');
Route::get('/terms-of-service-alias', [PublicController::class, 'terms'])->name('terms-of-service');
Route::get('/pusat-privasi-alias', [PublicController::class, 'privacy'])->name('pusat.privasi');
Route::get('/pusat-syarat-alias', [PublicController::class, 'terms'])->name('pusat.syarat');
Route::get('/partnership-alias', [PublicController::class, 'partnerships'])->name('wisatawan.partnership');
Route::post('/ulasan-store', [UlasanController::class, 'store'])->name('ulasan.store');

Route::get('/privacy', [PublicController::class, 'privacy'])->name('wisatawan.privacy');
Route::get('/terms', [PublicController::class, 'terms'])->name('wisatawan.terms');
Route::get('/contact', [PublicController::class, 'contact'])->name('wisatawan.contact');
Route::get('/partnerships', [PublicController::class, 'partnerships'])->name('wisatawan.partnerships');

Route::get('/katalog', [WisatawanController::class, 'katalog'])->name('wisatawan.katalog');
Route::get('/peta-kuliner', [WisatawanController::class, 'peta'])->name('wisatawan.peta');
Route::get('/kategori/{slug}', [WisatawanController::class, 'kategori'])->name('wisatawan.kategori');
Route::get('/detail-restoran/{id?}', [WisatawanController::class, 'detailRestoran'])->name('wisatawan.detail-restoran');

// =====================
// WISATAWAN ROUTES
// =====================
Route::middleware(['auth', 'role:wisatawan'])->group(function () {

    Route::get('/homepage-wisatawan', [WisatawanController::class, 'homepage'])->name('wisatawan.homepage');

    Route::get('/dashboard', [WisatawanController::class, 'homepage'])->name('wisatawan.dashboard');

    Route::get('/tentang', [WisatawanController::class, 'tentang'])->name('wisatawan.tentang');

    // Tulis Ulasan
    Route::get('/tulis-ulasan', function () {
        return view('Wisatawan.tulisUlasan');
    })->name('wisatawan.tulis-ulasan');

    Route::get('/formulir-reservasi', [WisatawanController::class, 'formulirReservasi'])->name('wisatawan.formulir-reservasi');
    Route::post('/reservasi', [WisatawanController::class, 'storeReservasi'])->name('wisatawan.reservasi.store');
    Route::get('/konfirmasi-reservasi/{id}', [WisatawanController::class, 'konfirmasiReservasi'])->name('wisatawan.konfirmasi-reservasi');

    Route::get('/notifikasi-status', function () {
        return view('Wisatawan.reservasiBerhasil'); // TODO: create dedicated notifikasi view
    })->name('wisatawan.notifikasi-status');

    // Ulasan
    Route::get('/ulasan-saya', [WisatawanController::class, 'ulasanSaya'])->name('wisatawan.ulasan');

    // Profil Wisatawan
    Route::get('/profil', [WisatawanController::class, 'profil'])->name('wisatawan.profil');
    Route::post('/profil/update', [WisatawanController::class, 'updateProfile'])->name('wisatawan.profil.update');
});

// =====================
// RESTO (MITRA) ROUTES
// =====================
Route::prefix('resto')->name('resto.')->middleware(['auth', 'role:mitra'])->group(function () {
    Route::get('/status-pendaftaran', [RestoController::class, 'statusPendaftaran'])->name('status-pendaftaran');

    Route::middleware(['resto.verified'])->group(function () {
        Route::get('/dashboard', [RestoController::class, 'dashboard'])->name('dashboard');
        Route::get('/restoran-saya', [RestoController::class, 'restoSaya'])->name('restoSaya');
        Route::get('/booking', [RestoController::class, 'booking'])->name('booking');
        Route::get('/galeri', [RestoController::class, 'galeri'])->name('galeri');
        Route::get('/reviews', [RestoController::class, 'reviews'])->name('reviews');
        Route::get('/profil-admin', [RestoController::class, 'profilAdmin'])->name('profilAdmin');
        Route::get('/profil-usaha', [RestoController::class, 'profilUsaha'])->name('profilUsaha');
        Route::get('/sertifikasi', [RestoController::class, 'sertifikasi'])->name('sertifikasi');
        Route::get('/edit-resto', [RestoController::class, 'editResto'])->name('editResto');

        // Post actions
        Route::post('/booking/{id}/status', [RestoController::class, 'updateBookingStatus'])->name('booking.status');
        Route::post('/reviews/{id}/reply', [RestoController::class, 'replyReview'])->name('reviews.reply');
        Route::post('/profile/update', [RestoController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/account/update', [RestoController::class, 'updateAccount'])->name('profile.account.update');
        Route::post('/menu/store', [RestoController::class, 'storeMenu'])->name('menu.store');
        Route::delete('/menu/{id}', [RestoController::class, 'deleteMenu'])->name('menu.delete');
        Route::post('/certification/upload', [RestoController::class, 'uploadCertification'])->name('certification.upload');
    });
});

// =====================
// DINAS ROUTES
// =====================
Route::prefix('dinas')->name('dinas.')->middleware(['auth', 'role:admin_dinas'])->group(function () {
    Route::get('/dashboard', [DinasController::class, 'dashboard'])->name('dashboard');
    Route::get('/verifikasi', [DinasController::class, 'verifikasi'])->name('verifikasi');
    Route::post('/verifikasi/{id}/status', [DinasController::class, 'updateStatus'])->name('verifikasi.status');
    Route::get('/ulasan', [DinasController::class, 'ulasan'])->name('ulasan');
    Route::delete('/ulasan/{id}', [DinasController::class, 'deleteReview'])->name('ulasan.delete');
    Route::get('/sertifikasi', [DinasController::class, 'sertifikasi'])->name('sertifikasi');
    Route::post('/sertifikasi/{id}/status', [DinasController::class, 'updateSertifikasiStatus'])->name('sertifikasi.status');
    Route::get('/sertifikat-halal', [DinasController::class, 'sertifikatHalal'])->name('sertifikatHalal');
    Route::get('/profil', [DinasController::class, 'profil'])->name('profil');
    Route::post('/profil/update', [DinasController::class, 'updateProfile'])->name('profil.update');
});
