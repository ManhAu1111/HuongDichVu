<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthProxyController;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartPageController;


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
Route::get('/shop_side_v2', [ProductController::class, 'shop'])->name('shop.side_v2');
Route::get('/cart', [CartPageController::class, 'index'])->name('cart');



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
    // ->middleware('auth.token')
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
// Route::view('/dashManageOrder', 'dash.dashManageOrder')->name('dash.ManageOrder');
Route::get('/dashManageOrder/{public_id}', function ($public_id) {
    return view('dash.dashManageOrder', compact('public_id'));
})->name('dash.ManageOrder');

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



/*
|--------------------------------------------------------------------------
| ADMIN PANEL (VIEW ONLY) - Protected Routes
|--------------------------------------------------------------------------
| Routes này chỉ dùng để hiển thị giao diện Blade files (dùng Route::view)
|
| Lưu ý: Vẫn nên bảo vệ bằng middleware (ví dụ: 'auth.admin') khi triển khai thực tế
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // 1. ADMIN DASHBOARD
    Route::view('/', 'admin.dashboard.index')->name('dashboard');

    // 2. QUẢN LÝ SẢN PHẨM
    Route::prefix('products')->name('products.')->group(function () {
        // GET /admin/products -> admin.products.index (Danh sách)
        Route::view('/', 'admin.products.index')->name('index');

        // GET /admin/products/create -> admin.products.create (Form thêm)
        Route::view('/create', 'admin.products.create_edit')->name('create');

        // GET /admin/products/1/edit -> admin.products.edit (Form sửa)
        // Dùng một route GET đơn giản để mô phỏng trang sửa
        Route::get('/{id}/edit', function ($id) {
            return view('admin.products.create_edit', ['id' => $id]);
        })->name('edit');
    });

    // 3. QUẢN LÝ ĐƠN HÀNG
    Route::prefix('orders')->name('orders.')->group(function () {
        // GET /admin/orders -> admin.orders.index (Danh sách)
        Route::view('/', 'admin.orders.index')->name('index');

        // GET /admin/orders/1 -> admin.orders.detail (Chi tiết)
        Route::get('/{id}', function ($id) {
            return view('admin.orders.detail', ['id' => $id]);
        })->name('detail');
    });

    // 4. QUẢN LÝ NGƯỜI DÙNG
    Route::prefix('users')->name('users.')->group(function () {
        // GET /admin/users -> admin.users.index (Danh sách)
        Route::view('/', 'admin.users.index')->name('index');
    });

    // 5. CÀI ĐẶT HỆ THỐNG
    Route::view('/settings', 'admin.settings.index')->name('settings');

    // 6. LOGOUT (Chỉ cần route name cho Sidebar)
    // Tạm thời trỏ về trang đăng nhập admin
    Route::post('/logout', function () {
        return redirect()->route('login');
    })->name('logout');
});
