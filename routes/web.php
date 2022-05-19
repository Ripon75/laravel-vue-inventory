<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Check authentication
Route::middleware(['auth:sanctum'])->group(function() {
    Route::resource('categories', CategoryController::class);
});

