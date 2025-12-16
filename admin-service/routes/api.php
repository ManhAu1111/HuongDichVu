<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group to your service. Enjoy building your API!
|
*/

// Ví dụ về một route API cơ bản cho Admin
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Thêm các route Admin của bạn ở đây:
Route::prefix('admin')->group(function () {
    Route::get('orders/summary', 'App\Http\Controllers\Admin\OrderController@getSummary');
    Route::put('products/{id}', 'App\Http\Controllers\Admin\ProductController@update');
});
