<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment/momo', [PaymentController::class, 'momoPayment']);
Route::get('/payment/momo/callback', [PaymentController::class, 'momoCallback']);

// api routes
// Route::post('/momo/create', [PaymentController::class, 'momoPayment']);