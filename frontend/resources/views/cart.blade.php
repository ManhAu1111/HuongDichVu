{{-- 1. Kế thừa layout --}}
@extends('layouts.app')

{{-- 2. Title --}}
@section('title', 'Giỏ Hàng')

{{-- 3. Nội dung trang --}}
@section('content')
<div class="app-content">

    <!--====== Breadcrumb ======-->
    <div class="u-s-p-y-60">
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">
                                <a href="{{ route('shop.index') }}">Trang Chủ</a>
                            </li>
                            <li class="is-marked">
                                <a href="{{ route('cart') }}">Giỏ Hàng</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End Breadcrumb ======-->


    <!--====== Giỏ Hàng ======-->
    <div class="u-s-p-b-60">

        <div class="section__intro u-s-m-b-60">
            <div class="container">
                <h1 class="section__heading u-c-secondary">GIỎ HÀNG</h1>
            </div>
        </div>

        <div class="section__content">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 u-s-m-b-30">
                        <div class="table-responsive">
                            <table class="table-p">
                                <tbody>
                                    <!--====== SP 1 ======-->
                                    <tr>
                                        <td>
                                            <div class="table-p__box">
                                                <div class="table-p__img-wrap">
                                                    <img class="u-img-fluid"
                                                        src="images/product/electronic/product3.jpg" alt="">
                                                </div>

                                                <div class="table-p__info" data-product-id="1" data-price="125"
                                                    data-quantity="1" data-subtotal="125">
                                                    <span class="table-p__name">
                                                        <a href="product-detail.html">Tai nghe không dây màu vàng</a>
                                                    </span>
                                                    <span class="table-p__category">
                                                        <a href="#">Điện tử</a>
                                                    </span>

                                                    <ul class="table-p__variant-list">
                                                        <li><span>Kích thước: 22</span></li>
                                                        <li><span>Màu sắc: Đỏ</span></li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </td>

                                        <td><span class="table-p__price">125.00$</span></td>

                                        <td>
                                            <div class="table-p__input-counter-wrap">
                                                <div class="input-counter">
                                                    <span class="input-counter__minus fas fa-minus"></span>
                                                    <input class="input-counter__text input-counter--text-primary-style"
                                                        type="text" value="1" data-min="1" data-max="1000">
                                                    <span class="input-counter__plus fas fa-plus"></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="table-p__del-wrap">
                                                <a class="far fa-trash-alt table-p__delete-link" href="#"></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--====== End SP 1 ======-->

                                    <!--====== SP 2 ======-->
                                    <tr>
                                        <td>
                                            <div class="table-p__box">
                                                <div class="table-p__img-wrap">
                                                    <img class="u-img-fluid" src="images/product/women/product8.jpg"
                                                        alt="">
                                                </div>

                                                <div class="table-p__info" data-product-id="2" data-price="125"
                                                    data-quantity="1" data-subtotal="125">
                                                    <span class="table-p__name">
                                                        <a href="#">Váy nữ đẹp – Elegant Dress</a>
                                                    </span>
                                                    <span class="table-p__category">
                                                        <a href="#">Thời trang nữ</a>
                                                    </span>

                                                    <ul class="table-p__variant-list">
                                                        <li><span>Kích thước: 22</span></li>
                                                        <li><span>Màu sắc: Đỏ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

                                        <td><span class="table-p__price">125.00$</span></td>

                                        <td>
                                            <div class="table-p__input-counter-wrap">
                                                <div class="input-counter">
                                                    <span class="input-counter__minus fas fa-minus"></span>
                                                    <input class="input-counter__text input-counter--text-primary-style"
                                                        type="text" value="1" data-min="1" data-max="1000">
                                                    <span class="input-counter__plus fas fa-plus"></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="table-p__del-wrap">
                                                <a class="far fa-trash-alt table-p__delete-link" href="#"></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--====== End SP 2 ======-->

                                    <!--====== SP 3 ======-->
                                    <tr>
                                        <td>
                                            <div class="table-p__box">
                                                <div class="table-p__img-wrap">
                                                    <img class="u-img-fluid" src="images/product/men/product8.jpg"
                                                        alt="">
                                                </div>

                                                <div class="table-p__info" data-product-id="3" data-price="125"
                                                    data-quantity="1" data-subtotal="125">
                                                    <span class="table-p__name">
                                                        <a href="#">Áo thời trang nam – Elegant Fashion</a>
                                                    </span>
                                                    <span class="table-p__category">
                                                        <a href="#">Thời trang nam</a>
                                                    </span>

                                                    <ul class="table-p__variant-list">
                                                        <li><span>Kích thước: 22</span></li>
                                                        <li><span>Màu sắc: Đỏ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

                                        <td><span class="table-p__price">125.00$</span></td>

                                        <td>
                                            <div class="table-p__input-counter-wrap">
                                                <div class="input-counter">
                                                    <span class="input-counter__minus fas fa-minus"></span>
                                                    <input class="input-counter__text input-counter--text-primary-style"
                                                        type="text" value="1" data-min="1" data-max="1000">
                                                    <span class="input-counter__plus fas fa-plus"></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="table-p__del-wrap">
                                                <a class="far fa-trash-alt table-p__delete-link" href="#"></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--====== End SP 3 ======-->

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Các nút điều hướng -->
                    <div class="col-lg-12">
                        <div class="route-box">
                            <div class="route-box__g1">
                                <a class="route-box__link" href="{{ route('shop.index') }}">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span>Tiếp tục mua hàng</span>
                                </a>
                            </div>

                            <div class="route-box__g2">
                                <a class="route-box__link" href="#">
                                    <i class="fas fa-trash"></i>
                                    <span>Xóa giỏ hàng</span>
                                </a>

                                <a class="route-box__link" href="#">
                                    <i class="fas fa-sync"></i>
                                    <span>Cập nhật giỏ hàng</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!--====== End Giỏ Hàng ======-->


    <!--====== Ước tính phí + Ghi chú + Tổng ======-->
    <div class="u-s-p-b-60">
        <div class="section__content">
            <div class="container">
                <form class="f-cart">
                    <div class="row">

                        <!-- Ước tính phí -->
                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                            <div class="f-cart__pad-box">

                                <h1 class="gl-h1">ƯỚC TÍNH PHÍ GIAO HÀNG</h1>
                                <span class="gl-text u-s-m-b-30">
                                    Nhập thông tin để hệ thống tính phí giao hàng.
                                </span>

                                <div class="u-s-m-b-30">
                                    <label class="gl-label">Quốc gia *</label>
                                    <span class="text-dark fw-bold">Việt Nam</span>
                                </div>

                                <div class="u-s-m-b-30">
                                    <label class="gl-label">Tỉnh / Thành *</label>
                                    <select id="province-select" class="select-box select-box--primary-style">
                                        <option value="">Đang tải danh sách...</option>
                                    </select>
                                </div>

                                <div class="u-s-m-b-30">
                                    <label class="gl-label">Mã bưu điện *</label>
                                    <input class="input-text input-text--primary-style" type="text"
                                        placeholder="VD: 100000">
                                </div>

                                <div class="u-s-m-b-30">
                                    <button type="button" id="btnCalculateShipping" class="btn btn--e-brand-b-2">
                                        Tính phí giao hàng
                                    </button>

                                </div>

                                <span class="gl-text">
                                    * Một số khu vực có thể được miễn phí giao hàng tùy chính sách.
                                </span>

                            </div>
                        </div>

                        <!-- Ghi chú -->
                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                            <div class="f-cart__pad-box">
                                <h1 class="gl-h1">GHI CHÚ ĐƠN HÀNG</h1>
                                <span class="gl-text u-s-m-b-30">Thêm ghi chú cho đơn hàng của bạn</span>
                                <textarea class="text-area text-area--primary-style"></textarea>
                            </div>
                        </div>

                        <!-- Tổng tiền -->
                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                            <div class="f-cart__pad-box">

                                <div class="u-s-m-b-30">
                                    <table class="f-cart__table">
                                        <tbody>
                                            <tr>
                                                <td>Phí giao hàng</td>
                                                <td id="shipping-fee-display">0 đ</td>
                                            </tr>
                                            <tr>
                                                <td>Tạm tính</td>
                                                <td id="subtotal-display" data-value="0">0 đ</td>
                                            </tr>
                                            <tr>
                                                <td>Tổng cộng</td>
                                                <td id="grand-total-display">0 đ</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div>
                                    <a href="{{ route('checkout') }}" class="btn btn--e-brand-b-2">
                                        Tiến hành thanh toán
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--====== End Tổng ======-->

</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const provinceSelect = document.getElementById("province-select");
        const btnCheckout = document.getElementById("btnCheckout");
        const btnCalculate = document.getElementById("btnCalculateShipping");
        const shippingDisplay = document.getElementById("shipping-fee-display");
        const subtotalEl = document.getElementById("subtotal-display");
        const grandTotalEl = document.getElementById("grand-total-display");

        // Debug ID nếu element không tồn tại
        if (!provinceSelect) console.error("Không tìm thấy #province-select");
        if (!btnCheckout) console.warn("Không tìm thấy #btnCheckout (OK nếu chưa cần checkout)");
        if (!btnCalculate) console.error("Không tìm thấy #btnCalculateShipping");
        if (!shippingDisplay) console.error("Không tìm thấy #shipping-fee-display");

        // 1) Load danh sách tỉnh/thành từ API
        fetch("https://provinces.open-api.vn/api/p/")
            .then(response => response.json())
            .then(data => {
                provinceSelect.innerHTML = '<option value="">Chọn tỉnh/thành</option>';
                data.forEach(p => {
                    let opt = document.createElement("option");
                    opt.value = p.code;
                    opt.textContent = p.name;
                    provinceSelect.appendChild(opt);
                });
            })
            .catch(err => {
                console.error("Lỗi khi load API tỉnh:", err);
                provinceSelect.innerHTML = '<option value="">Không tải được danh sách tỉnh</option>';
            });

        // 2) Hàm gọi API tính phí giao hàng
        function calculateShipping(provinceCode) {
            return fetch("http://127.0.0.1:8002/api/calculate-shipping", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        province_code: Number(provinceCode)
                    })
                })
                .then(res => {
                    if (!res.ok) return res.text().then(t => {
                        throw new Error("Server error: " + t);
                    });
                    return res.json();
                });
        }

        // 3) Event: Nhấn nút “Tính phí giao hàng”
        btnCalculate.addEventListener("click", function() {
            const provinceCode = provinceSelect.value;

            if (!provinceCode) {
                alert("Bạn phải chọn tỉnh/thành trước.");
                return;
            }

            calculateShipping(provinceCode)
                .then(data => {
                    // Cập nhật phí ship
                    shippingDisplay.innerText = new Intl.NumberFormat("vi-VN").format(data
                        .shipping_fee) + " đ";

                    // Cập nhật tổng tiền (nếu có subtotal)
                    if (subtotalEl && grandTotalEl) {
                        const subtotal = Number(subtotalEl.dataset.value ?? 0);
                        const total = subtotal + data.shipping_fee;
                        grandTotalEl.innerText = new Intl.NumberFormat("vi-VN").format(total) + " đ";
                    }
                })
                .catch(err => {
                    console.error("Lỗi API calculate-shipping:", err);
                    alert("Không tính được phí giao hàng. Kiểm tra console hoặc backend.");
                });
        });

        // 4) Event: Tự động tính lại khi đổi tỉnh (tùy chọn)
        provinceSelect.addEventListener("change", function() {
            // Không tính tự động nữa — chỉ đổi tỉnh thôi
            console.log("Đã chọn tỉnh:", this.value);
        });

    });
</script>


@endsection