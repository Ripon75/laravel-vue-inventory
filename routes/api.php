<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [CategoryController::class, 'getCategoryJson']);
Route::get('/brands',     [BrandController::class, 'getBrandJson']);
Route::get('/sizes',      [SizeController::class, 'getSizeJson']);
Route::get('/products',   [ProductController::class, 'getProductJson']);

