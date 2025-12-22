{{-- resources/views/admin/orders/detail.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Chi Tiết Đơn Hàng #3054231326')

@section('admin_content')

<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Đơn Hàng #3054231326</h1>
        <span class="dash__text u-s-m-b-30">Ngày đặt: 01/12/2025 | Tình trạng: <span class="gl-label u-c-brand">Chờ xác nhận</span></span>

        <div class="row">
            {{-- Cột 1: Thông tin Khách hàng & Vận chuyển --}}
            <div class="col-lg-6 u-s-m-b-30">
                <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                    <div class="dash__pad-3">
                        <h2 class="dash__h2 u-s-m-b-8">THÔNG TIN KHÁCH HÀNG</h2>
                        <span class="dash__text">John Doe</span>
                        <span class="dash__text">johndoe@domain.com</span>
                        <span class="dash__text">(+0) 900901904</span>

                        <h2 class="dash__h2 u-s-m-t-20 u-s-m-b-8">ĐỊA CHỈ GIAO HÀNG</h2>
                        <span class="dash__text">4247 Ashford Drive Virginia - VA-20006 - USA</span>
                    </div>
                </div>
            </div>

            {{-- Cột 2: Tóm tắt Đơn hàng & Thanh toán --}}
            <div class="col-lg-6 u-s-m-b-30">
                <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                    <div class="dash__pad-3">
                        <h2 class="dash__h2 u-s-m-b-8">TÓM TẮT THANH TOÁN</h2>
                        <table class="f-cart__table">
                            <tbody>
                                <tr><td>Tổng phụ</td><td>$125.00</td></tr>
                                <tr><td>Phí vận chuyển</td><td>$4.00</td></tr>
                                <tr><td>Tổng cộng</td><td>$129.00</td></tr>
                            </tbody>
                        </table>
                        <h2 class="dash__h2 u-s-m-t-20 u-s-m-b-8">PHƯƠNG THỨC</h2>
                        <span class="dash__text">Thanh toán khi nhận hàng (COD)</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bảng Sản phẩm trong đơn hàng --}}
        <h2 class="dash__h2 u-s-m-t-30 u-s-p-xy-20">SẢN PHẨM ĐÃ ĐẶT</h2>
        <div class="dash__table-wrap gl-scroll">
            <table class="dash__table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Yellow Wireless Headphone</td>
                        <td>$125.00</td>
                        <td>1</td>
                        <td>$125.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Hành động --}}
        <div class="u-s-m-t-30">
            <button class="btn btn--e-brand-b-2" type="button"><i class="fas fa-check u-s-m-r-6"></i> XÁC NHẬN ĐƠN HÀNG</button>
            <button class="btn btn--e-grey-b-2" type="button"><i class="fas fa-times u-s-m-r-6"></i> HỦY ĐƠN HÀNG</button>
        </div>
    </div>
</div>
@endsection
