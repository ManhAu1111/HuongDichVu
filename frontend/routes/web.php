<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthProxyController;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| BLOG
|--------------------------------------------------------------------------
*/

Route::view('/detail', 'blog.detail')->name('blog.detail');
Route::view('/blogRightSidebar', 'blog.blogRightSidebar')->name('blog.RightSidebar');
Route::view('/blogLeftSidebar', 'blog.blogLeftSidebar')->name('blog.LeftSidebar');
Route::view('/blogSidebarNone', 'blog.blogSidebarNone')->name('blog.SidebarNone');
Route::view('/blogMasonry', 'blog.blogMasonry')->name('blog.Masonry');

/*
|--------------------------------------------------------------------------
| SHOP
|--------------------------------------------------------------------------
*/

Route::get('/index', [ProductController::class, 'index'])->name('shop.index');
Route::view('/index2', 'shop.index2')->name('shop.index2');
Route::view('/index3', 'shop.index3')->name('shop.index3');
Route::view('/shopGridFull', 'shop.shopGridFull')->name('shop.GridFull');
Route::view('/shopGridLeft', 'shop.shopGridLeft')->name('shop.GridLeft');
Route::view('/shopGridRight', 'shop.shopGridRight')->name('shop.GridRight');
Route::view('/shopListFull', 'shop.shopListFull')->name('shop.ListFull');
Route::view('/shopListLeft', 'shop.shopListLeft')->name('shop.ListLeft');
Route::view('/shopListRight', 'shop.shopListRight')->name('shop.ListRight');
Route::get('/category/{id}', [ProductController::class, 'byCategory'])->name('shop.category');

/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
*/

Route::view('/productDetailAffiliate', 'products.productDetailAffiliate')->name('products.DetailAffiliate');
Route::view('/productDetailVariable', 'products.productDetailVariable')->name('products.DetailVariable');
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('products.detail');
Route::view('/checkout', 'products.checkout')->name('checkout');
Route::view('/cart', 'cart')->name('cart');
Route::get('/shop_side_v2', [ProductController::class, 'shop'])->name('shop.side_v2');


// Login page
Route::view('/signin', 'signin')
    ->middleware('guest.token')
    ->name('login');

// Register page
Route::view('/signup', 'signup')
    ->middleware('guest.token')
    ->name('register');

// API login/register
Route::post('/auth/login', [AuthProxyController::class, 'login'])->name('auth.login');
Route::post('/auth/register', [AuthProxyController::class, 'register'])->name('auth.register');

Route::post('/logout', function () {
    $cookie = Cookie::forget('auth_token');
    return redirect('/signin')->withCookie($cookie);
})->name('logout');


// Lost password
Route::view('/lost_password', 'lost_password')->name('password.request');

/*
|--------------------------------------------------------------------------
| DASHBOARD — Protected Routes
|--------------------------------------------------------------------------
*/

Route::view('/dashboard', 'dashboard')
    ->middleware('auth.token')
    ->name('dashboard');

Route::view('/dash_my_profile', 'dash.dash_my_profile')->name('dash.my_profile');
Route::view('/dashAddressAdd', 'dash.dashAddressAdd')->name('dash.AddressAdd');
Route::view('/dashAddressEdit', 'dash.dashAddressEdit')->name('dash.AddressEdit');
Route::view('/dashEditProfile', 'dash.dashEditProfile')->name('dash.EditProfile');
Route::view('/dashAddressMakeDefault', 'dash.dashAddressMakeDefault')->name('dash.AddressMakeDefault');
Route::view('/dash_address_book', 'dash.dash_address_book')->name('dash.address_book');
Route::view('/dash_track_order', 'dash.dash_track_order')->name('dash.track_order');
Route::view('/dash_my_order', 'dash.dash_my_order')->name('dash.my_order');
Route::view('/dash_payment_option', 'dash.dash_payment_option')->name('dash.payment_option');
Route::view('/dash_cancellation', 'dash.dash_cancellation')->name('dash.cancellation');
Route::view('/dashManageOrder', 'dash.dashManageOrder')->name('dash.ManageOrder');

/*
|--------------------------------------------------------------------------
| EMPTY PAGES
|--------------------------------------------------------------------------
*/

Route::view('/emptyCart', 'empty.emptyCart')->name('empty.Cart');
Route::view('/emptySearch', 'empty.emptySearch')->name('empty.Search');
Route::view('/emptyWishlist', 'empty.emptyWishlist')->name('empty.Wishlist');

/*
|--------------------------------------------------------------------------
| OTHER PAGES
|--------------------------------------------------------------------------
*/

Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');
Route::view('/404', '404')->name('404');
Route::view('/contact', 'contact')->name('contact');
Route::view('/wishlist', 'wishlist')->name('wishlist');

