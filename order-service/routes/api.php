<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::post('/checkout', [OrderController::class, 'checkout']);
Route::post('/calculate-shipping', [OrderController::class, 'calculateShipping']);

// Payment routes (momo payment)
Route::post('/update-payment-status', [OrderController::class, 'updatePaymentStatus']);

// Route::options('/{any}', fn() => response()->json())->where('any', '.*');