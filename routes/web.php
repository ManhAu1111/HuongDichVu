<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/detail', function () {
    return view('blog.detail');
});
Route::get('/index', function () {
    return view('shop.index');
});
Route::get('/product_detail', function () {
    return view('products.product_detail');
});
Route::get('/checkout', function () {
    return view('products.checkout');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/signin', function () {
    return view('signin');
});
Route::get('/lost_password', function () {
    return view('lost_password');
});
Route::get('/shop_side_v2', function () {
    return view('shop.shop_side_v2');
});
Route::get('/dash_my_profile', function () {
    return view('dash.dash_my_profile');
});
Route::get('/dash_address_book', function () {
    return view('dash.dash_address_book');
});
Route::get('/dash_track_order', function () {
    return view('dash.dash_track_order');
});
Route::get('/dash_my_order', function () {
    return view('dash.dash_my_order');
});
Route::get('/dash_payment_option', function () {
    return view('dash.dash_payment_option');
});
Route::get('/dash_cancellation', function () {
    return view('dash.dash_cancellation');
});
