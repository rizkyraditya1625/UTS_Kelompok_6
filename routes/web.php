<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- BAGIAN TAMU (Belum Login) ---
Route::middleware(['guest'])->group(function () {
    
    // 1. Halaman Depan (Root) -> Landing Page (PERBAIKAN DISINI)
    Route::get('/', function () {
        return view('welcome');
    });

    // 2. Halaman Login (Wajib ada nama 'login' untuk redirect auth)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    
    // 3. Proses Login
    Route::post('/login', [AuthController::class, 'login']);
    
    // 4. Register
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);

    // 5. Lupa Password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword']);
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
    
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword']);
    Route::post('/reset-password', [AuthController::class, 'updatePassword']);
});

// --- BAGIAN MEMBER (Sudah Login) ---
Route::middleware(['auth'])->group(function () {
    // Halaman Utama
    Route::get('/home', [ItemController::class, 'index'])->name('home');
    
    // Profil
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/profile/photo', [AuthController::class, 'updatePhoto']);
    Route::get('/user/{id}', [AuthController::class, 'showUserProfile']); // Lihat profil orang lain
    
    // Menu Tambahan
    Route::get('/about', function () { return view('about'); });
    Route::get('/history', [ItemController::class, 'history']);

    // CRUD Barang
    Route::get('/post/create', [ItemController::class, 'create']);
    Route::post('/post/store', [ItemController::class, 'store']);
    Route::get('/post/{id}', [ItemController::class, 'show']); // Detail
    
    // Aksi Barang
    Route::post('/post/done/{id}', [ItemController::class, 'markAsDone']); // Selesai
    Route::get('/post/edit/{id}', [ItemController::class, 'edit']); // Edit
    Route::post('/post/update/{id}', [ItemController::class, 'update']); // Update
    Route::post('/post/delete/{id}', [ItemController::class, 'destroy']); // Hapus

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    // Hapus History (Admin Only)
    Route::post('/history/delete/{id}', [ItemController::class, 'deleteHistory']);
});