<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReturnProductController;


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

Route::get('/logout',[ UserController::class, 'logout'])->name('users.logout');

// Check authentication
Route::middleware(['auth:sanctum'])->group(function() {
    // Users route
    Route::resource('users', UserController::class);
    // Category route
    Route::resource('categories', CategoryController::class);
    // Brand route
    Route::resource('brands', BrandController::class);
    // Size route
    Route::resource('sizes', SizeController::class);
    // Product route
    Route::resource('products', ProductController::class);
    // Stock route
    Route::get('/stocks', [StockController::class, 'stock'])->name('stocks');
    Route::post('/stocks', [StockController::class, 'stockSubmit'])->name('stocks.submit');
    Route::get('/stocks/history', [StockController::class, 'history'])->name('stocks.history');
    // Return product route
    Route::get('/return-products', [ReturnProductController::class, 'returnProduct'])->name('return.products');
    Route::post('/return-products', [ReturnProductController::class, 'returnProductSubmit'])->name('return.products.submit');
    Route::get('/return-products/history', [ReturnProductController::class, 'history'])->name('return.products.history');
});

