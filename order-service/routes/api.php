<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

Route::post('/checkout', [OrderController::class, 'checkout']);
Route::post('/calculate-shipping', [OrderController::class, 'calculateShipping']);

// Payment routes (momo payment)
Route::post('/update-payment-status', [OrderController::class, 'updatePaymentStatus']);

// paid order (momo)
Route::post('/orders/create-paid', [OrderController::class, 'createPaidOrder']);
// Route::options('/{any}', fn() => response()->json())->where('any', '.*');

// Cart routes
Route::post('/cart/add', [CartController::class, 'add']);
Route::get('/cart', [CartController::class, 'list']);
Route::put('/cart/update', [CartController::class, 'update']);
Route::delete('/cart/{id}', [CartController::class, 'delete']);
Route::post('/cart/clear-all', [CartController::class, 'clear']);
Route::post('/checkout-from-cart', [OrderController::class, 'checkoutFromCart']);

// dashboard (detail order)
Route::get('/orders', [OrderController::class, 'getOrdersByUser']);
Route::get('/order-items', [OrderController::class, 'getByOrder']);
Route::get('/orders/{public_id}', [OrderController::class, 'getOrderByPublicId']);
