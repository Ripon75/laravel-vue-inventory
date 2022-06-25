<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StockController;


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
    // Category route
    Route::resource('categories', CategoryController::class);
    // Brand route
    Route::resource('brands', BrandController::class);
    // Size route
    Route::resource('sizes', SizeController::class);
    // Product route
    Route::resource('products', ProductController::class);
    // Stock route
    Route::get('/stock', [StockController::class, 'stock'])->name('stocks');
});

