<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;

// Route untuk tampilan welcome
Route::get('/', function () {
    return view('welcome');
});

// Route untuk tampilan home
Route::get('/home', function () {
    return view('home');
});

// Resource route untuk CategoryController
Route::resource('categories', CategoryController::class);
Route::resource('movies', MovieController::class);

