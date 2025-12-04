{{-- resources/views/admin/orders/index.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Quản Lý Đơn Hàng')

@section('admin_content')

<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Danh Sách Đơn Hàng</h1>

        <div class="u-s-m-b-30 d-flex justify-content-end">
            <form class="main-form" method="GET" style="width: 50%;">
                <label for="admin-order-search"></label>
                <input class="input-text input-text--border-radius input-text--style-1"
                       type="text" id="admin-order-search" name="search"
                       value="{{ request('search') }}" placeholder="Tìm kiếm theo mã đơn hàng...">
                <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
            </form>
        </div>

        <h2 class="dash__h2 u-s-p-xy-20">150 Đơn Hàng</h2>
        <div class="dash__table-wrap gl-scroll">
            <table class="dash__table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Tình trạng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>3054231326</td>
                        <td>John Doe</td>
                        <td>01/12/2025</td>
                        <td>$126.00</td>
                        <td><span class="gl-label u-c-brand">Chờ xác nhận</span></td>
                        <td>
                            <div class="dash__link dash__link--brand">
                                <a href="{{ route('admin.orders.detail', 1) }}">CHI TIẾT</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3054231327</td>
                        <td>Jane Smith</td>
                        <td>30/11/2025</td>
                        <td>$550.00</td>
                        <td><span class="gl-label u-c-secondary">Đã giao hàng</span></td>
                        <td>
                            <div class="dash__link dash__link--brand">
                                <a href="{{ route('admin.orders.detail', 2) }}">CHI TIẾT</a>
                            </div>
                        </td>
                    </tr>
                    {{-- Thêm các dòng đơn hàng khác tại đây --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
