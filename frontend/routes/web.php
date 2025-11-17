<?php

use Illuminate\Support\Facades\Route;

// ------ BLOG ---------
Route::get('/detail', function () {
    return view('blog.detail');
})->name('blog.detail'); // <--- Đặt tên

Route::get('/blogRightSidebar', function () {
    return view('blog.blogRightSidebar');
})->name('blog.RightSidebar'); // <--- Đặt tên

Route::get('/blogLeftSidebar', function () {
    return view('blog.blogLeftSidebar');
})->name('blog.LeftSidebar');

Route::get('/blogSidebarNone', function () {
    return view('blog.blogSidebarNone');
})->name('blog.SidebarNone');

Route::get('/blogMasonry', function () {
    return view('blog.blogMasonry');
})->name('blog.Masonry');


//----------Shop ---------
Route::get('/', function () {
    return view('shop.index');
})->name('shop.index'); // <--- Đặt tên

Route::get('/index2', function () {
    return view('shop.index2');
})->name('shop.index2'); // <--- Đặt tên

Route::get('/index3', function () {
    return view('shop.index3');
})->name('shop.index3'); // <--- Đặt tên

Route::get('/shopGridFull', function () {
    return view('shop.shopGridFull');
})->name('shop.GridFull'); // <--- Đặt tên

Route::get('/shopGridLeft', function () {
    return view('shop.shopGridLeft');
})->name('shop.GridLeft'); // <--- Đặt tên

Route::get('/shopGridRight', function () {
    return view('shop.shopGridRight');
})->name('shop.GridRight'); // <--- Đặt tên

Route::get('/shopListFull', function () {
    return view('shop.shopListFull');
})->name('shop.ListFull'); // <--- Đặt tên

Route::get('/shopListLeft', function () {
    return view('shop.shopListLeft');
})->name('shop.ListLeft'); // <--- Đặt tên

Route::get('/shopListRight', function () {
    return view('shop.shopListRight');
})->name('shop.ListRight'); // <--- Đặt tên





// ------ PRODUCTS ---------
Route::get('/productDetailAffiliate', function () {
    return view('products.productDetailAffiliate');
})->name('products.DetailAffiliate'); // <--- Đặt tên

Route::get('/productDetailVariable', function () {
    return view('products.productDetailVariable');
})->name('products.DetailVariable'); // <--- Đặt tên

Route::get('/product_detail', function () {
    return view('products.product_detail');
})->name('products.detail'); // <--- Đặt tên

Route::get('/checkout', function () {
    return view('products.checkout');
})->name('checkout'); // <--- Đặt tên

Route::get('/cart', function () {
    return view('cart');
})->name('cart'); // <--- Đặt tên

Route::get('/shop_side_v2', function () {
    return view('shop.shop_side_v2');
})->name('shop.side_v2'); // <--- Đặt tên

// Xác thực (Auth)
Route::get('/signup', function () {
    return view('signup');
})->name('register'); // (Dùng tên chuẩn 'register')

Route::get('/signin', function () {
    return view('signin');
})->name('login'); // (Dùng tên chuẩn 'login')

Route::get('/lost_password', function () {
    return view('lost_password');
})->name('password.request'); // (Dùng tên chuẩn)

// Dashboard người dùng
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); // <--- Đặt tên


// ------ DASH---------

Route::get('/dash_my_profile', function () {
    return view('dash.dash_my_profile');
})->name('dash.my_profile'); // <--- Đặt tên

Route::get('/dashAddressAdd', function () {
    return view('dash.dashAddressAdd');
})->name('dash.AddressAdd'); // <--- Đặt tên

Route::get('/dashAddressEdit', function () {
    return view('dash.dashAddressEdit');
})->name('dash.AddressEdit'); // <--- Đặt tên

Route::get('/dashEditProfile', function () {
    return view('dash.dashEditProfile');
})->name('dash.EditProfile'); // <--- Đặt tên

Route::get('/dashAddressMakeDefault', function () {
    return view('dash.dashAddressMakeDefault');
})->name('dash.AddressMakeDefault'); // <--- Đặt tên

Route::get('/dash_address_book', function () {
    return view('dash.dash_address_book');
})->name('dash.address_book'); // <--- Đặt tên

Route::get('/dash_track_order', function () {
    return view('dash.dash_track_order');
})->name('dash.track_order'); // <--- Đặt tên

Route::get('/dash_my_order', function () {
    return view('dash.dash_my_order');
})->name('dash.my_order'); // <--- Đặt tên

Route::get('/dash_payment_option', function () {
    return view('dash.dash_payment_option');
})->name('dash.payment_option'); // <--- Đặt tên

Route::get('/dash_cancellation', function () {
    return view('dash.dash_cancellation');
})->name('dash.cancellation'); // <--- Đặt tên

Route::get('/dashManageOrder', function () {
    return view('dash.dashManageOrder');
})->name('dash.ManageOrder'); // <--- Đặt tên

// --------------- EMPTY ---------------
Route::get('/emptyCart', function () {
    return view('empty.emptyCart');
})->name('empty.Cart'); // <--- Đặt tên

Route::get('/emptySearch', function () {
    return view('empty.emptySearch');
})->name('empty.Search'); // <--- Đặt tên

Route::get('/emptyWishlist', function () {
    return view('empty.emptyWishlist');
})->name('empty.Wishlist'); // <--- Đặt tên


//-------------- OTHER ---------------
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/404', function () {
    return view('404');
})->name('404');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/wishlist', function () {
    return view('wishlist');
})->name('wishlist');
