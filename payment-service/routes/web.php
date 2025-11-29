<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment/momo', [PaymentController::class, 'momoPayment']);
Route::get('/payment/momo/callback', [PaymentController::class, 'momoCallback']);

// Momo1 Payment Routes
// Route::post('/momo/create', [PaymentController::class, 'createPayment']);
// Route::get('/momo/return', [PaymentController::class, 'returnPayment']);
// Route::post('/momo/notify', [PaymentController::class, 'notifyPayment']);

// VNPAY Payment Routes
// Route::get('/payment/vnpay', [PaymentController::class, 'createPayment']);
// Route::get('/vnpay_return', [PaymentController::class, 'callback']);
// Route::get('/payment/vnpay/callback', [PaymentController::class, 'callback']);

// Sepay Payment Routes
// Route::post('/sepay/create', [\App\Http\Controllers\PaymentController::class, 'sepayCreate']);
// Route::post('/sepay/webhook', [\App\Http\Controllers\PaymentController::class, 'sepayWebhook']);