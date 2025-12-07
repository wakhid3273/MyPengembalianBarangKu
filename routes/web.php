<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Models\Item;

/*
|--------------------------------------------------------------------------
| Web Routes - MyPengembalianBarangKu
|--------------------------------------------------------------------------
*/

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes (Guest only - belum login)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    
    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Protected Routes (Harus login dulu)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        // Ambil upload terbaru dari semua user, diurutkan berdasarkan created_at terbaru
        $recentItems = Item::with(['category', 'reporter'])
            ->orderBy('created_at', 'desc')
            ->take(12) // Ambil 12 item terbaru
            ->get();
        
        return view('dashboard', compact('recentItems'));
    })->name('dashboard');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Routes untuk Profil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Routes untuk Items (Pelaporan Barang)
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    // Routes Pencarian Barang (letakkan sebelum route parameterized `/{id}`)
    Route::get('/items/search', [ItemController::class, 'search'])->name('items.search');
    Route::get('/items/detail/{id}', [ItemController::class, 'detail'])->name('items.detail');
    
    // Routes untuk Klaim Barang
    Route::post('/items/{id}/claim', [ItemController::class, 'claim'])->name('items.claim');
    
    // Routes untuk Edit dan Delete Item (hanya owner)
    Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

    // Route show untuk item berdasarkan id (letakkan setelah route spesifik di atas)
    Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');
});