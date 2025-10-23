<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');  

// Public Routes (Tidak Perlu Login)
Route::apiResource('transactions', TransactionController::class)->only(['index', 'show']);
Route::apiResource('books', BookController::class)->only(['index', 'show']);
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);

// Customer Routes (wajib login)
Route::middleware(['auth:api'])->group(function (){
    Route::post('transactions', [TransactionController::class, 'update', 'store', 'show']);

// Routes Admin (login + role admin)
    Route::middleware(['role:admin'])->group(function() {
        Route::apiResource('genres', GenreController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('transactions', TransactionController::class)->only(['index', 'destroy']);
        Route::apiResource('books', BookController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('authors', AuthorController::class)->only(['store', 'update', 'destroy']);
    });
});





