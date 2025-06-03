<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;

//Route untuk tampilan welcome
Route::get('/', function () {
   return view('welcome');
});

//Route untuk halaman home (menampilkan daftar film) tanpa middleware auth
Route::get('/home', [MovieController::class, 'home'])->name('home');

//Resource routes (bisa ditambahkan middleware auth jika perlu)
Route::resource('categories', CategoryController::class);
Route::resource('movies', MovieController::class);

// Tampilkan form login
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

// Proses login form
Route::post('/login', [AuthController::class, 'login']);

// Tambahan route logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
