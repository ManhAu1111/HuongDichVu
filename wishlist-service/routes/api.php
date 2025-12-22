<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;

Route::middleware('auth.jwt')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::post('/wishlist', [WishlistController::class, 'store']);
    Route::delete('/wishlist/{productId}', [WishlistController::class, 'destroy']);
    Route::delete('/wishlist', [WishlistController::class, 'clear']);
});
