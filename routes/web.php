<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class);

Route::get('/', fn () => redirect()->route('products.index'))->name('home');

Route::resource('products', ProductController::class);

// Penjualan
Route::get('/sales',  [SalesController::class, 'index'])->name('sales.index');
Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');

// Kelola Stok
Route::get('/stock',           [StockController::class, 'index'])->name('stock.index');
Route::post('/stock/increase', [StockController::class, 'increase'])->name('stock.increase');
Route::post('/stock/decrease', [StockController::class, 'decrease'])->name('stock.decrease');

// Laporan
Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');

// Kategori
Route::resource('categories', CategoryController::class)->except(['show']);
