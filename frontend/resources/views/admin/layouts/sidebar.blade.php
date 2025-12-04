{{-- resources/views/admin/layouts/sidebar.blade.php --}}
<div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
    <div class="dash__pad-1">

        <span class="dash__text u-s-m-b-16">Chào mừng, Admin Name</span>

        <ul class="dash__f-list">
            <li>
                {{-- Dùng Route::is để check và áp dụng class dash-active --}}
                <a class="{{ Route::is('admin.dashboard') ? 'dash-active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                   <i class="fas fa-chart-line u-s-m-r-6"></i> Tổng Quan
                </a>
            </li>
            <li class="u-s-m-t-10">
                <span class="dash__text u-s-m-b-8">QUẢN LÝ CỬA HÀNG</span>
            </li>
            <li>
                <a class="{{ Route::is('admin.products.*') ? 'dash-active' : '' }}"
                   href="{{ route('admin.products.index') }}">
                   <i class="fas fa-box-open u-s-m-r-6"></i> Sản Phẩm
                </a>
            </li>
            <li>
                <a class="{{ Route::is('admin.orders.*') ? 'dash-active' : '' }}"
                   href="{{ route('admin.orders.index') }}">
                   <i class="fas fa-shopping-bag u-s-m-r-6"></i> Đơn Hàng
                </a>
            </li>
            <li>
                <a class="{{ Route::is('admin.users.*') ? 'dash-active' : '' }}"
                   href="{{ route('admin.users.index') }}">
                   <i class="fas fa-users u-s-m-r-6"></i> Người Dùng
                </a>
            </li>
            <li class="u-s-m-t-10">
                <span class="dash__text u-s-m-b-8">HỆ THỐNG</span>
            </li>
            <li>
                <a class="{{ Route::is('admin.settings') ? 'dash-active' : '' }}"
                   href="{{ route('admin.settings') }}">
                   <i class="fas fa-cog u-s-m-r-6"></i> Cài Đặt Chung
                </a>
            </li>
            <li>
                <a href="#"
                    onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                    <i class="fas fa-sign-out-alt u-s-m-r-6"></i> Đăng Xuất
                </a>
                {{-- Giả định có form logout riêng cho Admin --}}
                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
