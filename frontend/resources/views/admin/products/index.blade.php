{{-- resources/views/admin/products/index.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Quản Lý Sản Phẩm')

@section('admin_content')

<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Danh Sách Sản Phẩm</h1>

        <div class="u-s-m-b-30 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.products.create') }}" class="btn btn--e-brand-b-2">
                <i class="fas fa-plus u-s-m-r-6"></i> Thêm Sản Phẩm
            </a>

            <form class="main-form" method="GET" style="width: 50%;">
                <label for="admin-product-search"></label>
                <input class="input-text input-text--border-radius input-text--style-1"
                       type="text" id="admin-product-search" name="search"
                       value="{{ request('search') }}" placeholder="Tìm kiếm theo tên...">
                <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
            </form>
        </div>

        <h2 class="dash__h2 u-s-p-xy-20">25 Sản Phẩm Tìm Thấy</h2>
        <div class="dash__table-wrap gl-scroll">
            <table class="dash__table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Kho hàng</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <div class="dash__table-img-wrap">
                                <img class="u-img-fluid" src="{{ asset('images/product/electronic/product3.jpg') }}" alt="">
                            </div>
                        </td>
                        <td>Yellow Wireless Headphone</td>
                        <td>$125.00</td>
                        <td>50</td>
                        <td><span class="gl-label u-c-brand">Active</span></td>
                        <td>
                            <div class="dash__link dash__link--brand">
                                <a href="{{ route('admin.products.edit', 1) }}">SỬA</a> |
                                <a href="#" onclick="confirm('Xác nhận xóa sản phẩm này?')">XÓA</a>
                            </div>
                        </td>
                    </tr>
                    {{-- Thêm các dòng sản phẩm khác tại đây --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
