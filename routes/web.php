<?php

use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\CategoryWebController;
use App\Http\Controllers\OrderWebController;
use App\Http\Controllers\ProductWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthWebController::class, 'showRegister'])->name('register');

Route::get('/products', [ProductWebController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductWebController::class, 'create'])->name('products.create');
Route::get('/products/{id}', [ProductWebController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductWebController::class, 'edit'])->name('products.edit');

Route::get('/categories', [CategoryWebController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryWebController::class, 'create'])->name('categories.create');
Route::get('/categories/{id}', [CategoryWebController::class, 'show'])->name('categories.show');
Route::get('/categories/{id}/edit', [CategoryWebController::class, 'edit'])->name('categories.edit');

Route::get('/orders', [OrderWebController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderWebController::class, 'show'])->name('orders.show');
