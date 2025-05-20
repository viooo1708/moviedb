<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;

// // Route untuk tampilan welcome
// Route::get('/', function () {
//     return view('welcome');
// });

// Route untuk halaman home (menampilkan daftar film)
Route::get('/', [MovieController::class, 'home'])->name('home');
// Route::get('/', [MovieController::class, 'homepage']);


// Resource routes
Route::resource('categories', CategoryController::class);
Route::resource('movies', MovieController::class);
