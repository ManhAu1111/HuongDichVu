<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/momo/create', [PaymentController::class, 'momoPayment']);




// Route::post('/momo/create', [PaymentController::class, 'createPayment']);
// Route::post('/momo/notify', [PaymentController::class, 'notifyPayment']);
// Route::get('/momo/return', [PaymentController::class, 'returnPayment']);