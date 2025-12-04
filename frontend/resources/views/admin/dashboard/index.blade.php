{{-- resources/views/admin/dashboard/index.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Tổng Quan')

@section('admin_content')

<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Tổng Quan Quản Trị</h1>
        <span class="dash__text u-s-m-b-30">Chào mừng bạn trở lại, Admin! Dưới đây là tổng hợp nhanh về hoạt động cửa hàng.</span>

        <div class="row">
            {{-- Widget 1: Tổng Doanh Thu (Tái sử dụng dash__w-wrap) --}}
            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                    <div class="dash__pad-3">
                        <div class="dash__w-wrap">
                            <span class="dash__w-icon dash__w-icon-style-1"><i class="fas fa-dollar-sign"></i></span>
                            <span class="dash__w-text">5,450,000</span>
                            <span class="dash__w-name">Tổng Doanh Thu (Tháng)</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Widget 2: Đơn Hàng Mới --}}
            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                    <div class="dash__pad-3">
                        <div class="dash__w-wrap">
                            <span class="dash__w-icon dash__w-icon-style-2"><i class="fas fa-shopping-bag"></i></span>
                            <span class="dash__w-text">12</span>
                            <span class="dash__w-name">Đơn Hàng Mới (Hôm nay)</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Widget 3: Sản Phẩm Trong Kho --}}
            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                    <div class="dash__pad-3">
                        <div class="dash__w-wrap">
                            <span class="dash__w-icon dash__w-icon-style-3"><i class="fas fa-cubes"></i></span>
                            <span class="dash__w-text">256</span>
                            <span class="dash__w-name">Tổng Sản Phẩm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bảng Đơn hàng gần đây --}}
<div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius">
    <h2 class="dash__h2 u-s-p-xy-20">ĐƠN HÀNG GẦN ĐÂY</h2>
    {{-- Tái sử dụng cấu trúc bảng từ dashboard.blade.php --}}
    <div class="dash__table-wrap gl-scroll">
        <table class="dash__table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Tình trạng</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>3054231326</td>
                    <td><span class="gl-label u-c-brand">Chờ xác nhận</span></td>
                    <td>John Doe</td>
                    <td>$126.00</td>
                    <td>
                        <div class="dash__link dash__link--brand">
                            <a href="{{ route('admin.orders.detail', 1) }}">CHI TIẾT</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
