<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

Route::post('/checkout', [OrderController::class, 'checkout']);
Route::post('/calculate-shipping', [OrderController::class, 'calculateShipping']);

// Payment routes (MoMo / payment callback)
Route::post('/update-payment-status', [OrderController::class, 'updatePaymentStatus']);
Route::post('/orders/create-paid', [OrderController::class, 'createPaidOrder']);

// =========================
// ORDER ACTIONS (USER)
// =========================
Route::post('/orders/{public_id}/cancel', [OrderController::class, 'cancelOrder']);

// =========================
// ORDER QUERY (DASHBOARD)
// =========================
Route::get('/orders', [OrderController::class, 'getOrdersByUser']);
Route::get('/order-items', [OrderController::class, 'getByOrder']);
Route::get('/orders/{public_id}', [OrderController::class, 'getOrderByPublicId']);

Route::post('/checkout-from-cart', [OrderController::class, 'checkoutFromCart']);

// =========================
// CART
// =========================
Route::post('/cart/add', [CartController::class, 'add']);
Route::get('/cart', [CartController::class, 'list']);
Route::put('/cart/update', [CartController::class, 'update']);
Route::delete('/cart/{id}', [CartController::class, 'delete']);
Route::post('/cart/clear-all', [CartController::class, 'clear']);
