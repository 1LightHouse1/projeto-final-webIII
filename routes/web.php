<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryWebController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderWebController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthWebController::class, 'showRegister'])->name('register');

Route::prefix('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        
        Route::apiResource('orders', OrderController::class);
        
        Route::middleware('can:manage-products')->group(function () {
            Route::post('/products', [ProductController::class, 'store']);
            Route::put('/products/{id}', [ProductController::class, 'update']);
            Route::delete('/products/{id}', [ProductController::class, 'destroy']);
        });
        
        Route::middleware('can:manage-categories')->group(function () {
            Route::post('/categories', [CategoryController::class, 'store']);
            Route::put('/categories/{id}', [CategoryController::class, 'update']);
            Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
        });
    });
});

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
