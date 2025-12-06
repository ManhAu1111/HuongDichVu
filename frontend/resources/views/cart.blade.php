{{-- 1. Kế thừa layout --}}
@extends('layouts.app')

{{-- 2. Title --}}
@section('title', 'Giỏ Hàng')

{{-- 3. Nội dung trang --}}
@section('content')

<script>
    @php
    echo 'window.APP_USER_ID = '.json_encode($userId).
    ';';
    @endphp
</script>


<div class="app-content">

    <!--====== Section 1 ======-->
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
                                    @if(count($cartItems) === 0)
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            GIỎ HÀNG TRỐNG
                                        </td>
                                    </tr>
                                    @else
                                    @foreach($cartItems as $item)
                                    <tr>
                                        <td>
                                            <div class="table-p__box">
                                                <div class="table-p__img-wrap">
                                                    <img class="u-img-fluid" src="{{ asset($item['primary_image']) }}"
                                                        alt="{{ $item['product_name'] }}">
                                                </div>

                                                <div class="table-p__info" data-product-id="{{ $item['product_id'] }}"
                                                    data-price="{{ $item['price'] }}"
                                                    data-quantity="{{ $item['quantity'] }}"
                                                    data-subtotal="{{ $item['price'] * $item['quantity'] }}">

                                                    <span class="table-p__name">
                                                        <a href="{{ route('products.detail', $item['product_id']) }}">
                                                            {{ $item['product_name'] }}
                                                        </a>
                                                    </span>

                                                    <span class="table-p__category">
                                                        <a href="#">
                                                            {{ $item['category_name'] ?? 'Danh mục' }}
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td><span class="table-p__price">{{ number_format($item['subtotal']) }} đ</span>
                                        </td>

                                        <td>
                                            <div class="table-p__input-counter-wrap">
                                                <div class="input-counter">
                                                    <span class="input-counter__minus fas fa-minus"
                                                        data-action="decrease" data-id="{{ $item['id'] }}"></span>

                                                    <input class="input-counter__text input-counter--text-primary-style"
                                                        type="text" value="{{ $item['quantity'] }}" data-min="1"
                                                        data-max="1000" data-id="{{ $item['id'] }}">

                                                    <span class="input-counter__plus fas fa-plus" data-action="increase"
                                                        data-id="{{ $item['id'] }}"></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="table-p__del-wrap">
                                                <a class="far fa-trash-alt table-p__delete-link" data-action="remove"
                                                    data-id="{{ $item['id'] }}"></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <!-- Các nút điều hướng -->
                    <div class="col-lg-12">
                        <div class="route-box">
                            <div class="route-box__g1">
                                <a class="route-box__link" href="{{ route('shop.side_v2') }}">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span>Tiếp tục mua hàng</span>
                                </a>
                            </div>

                            <div class="route-box__g2">
                                <a href="#" class="route-box__link js-clear-cart" data-user-id="{{ $userId }}">
                                    <i class="fas fa-trash"></i>
                                    <span>Xóa giỏ hàng</span>
                                </a>

                                <a href="#" class="route-box__link js-sync-cart" data-user-id="{{ $userId }}">
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

                                <!-- <div class="u-s-m-b-30">
                                    <label class="gl-label">Mã bưu điện *</label>
                                    <input class="input-text input-text--primary-style" type="text"
                                        placeholder="VD: 100000">
                                </div> -->

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
                                            @php
                                            $subtotal = array_sum(array_column($cartItems, 'subtotal'));
                                            @endphp

                                            <tr>
                                                <td>Tạm tính</td>
                                                <td id="subtotal-display" data-value="{{ $subtotal }}">
                                                    {{ number_format($subtotal) }} đ
                                                </td>
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
<!-- Xử lý phí ship -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // ===========================
        // 0) USER ID
        // ===========================
        const USER_ID = window.APP_USER_ID;
        const API_CART = "http://127.0.0.1:8002/api/cart";

        // ============================================================
        // 1) PHÍ SHIP
        // ============================================================

        const provinceSelect = document.getElementById("province-select");
        const btnCalculate = document.getElementById("btnCalculateShipping");
        const shippingDisplay = document.getElementById("shipping-fee-display");
        const subtotalEl = document.getElementById("subtotal-display");
        const grandTotalEl = document.getElementById("grand-total-display");

        // Load danh sách tỉnh/thành
        if (provinceSelect) {
            fetch("https://provinces.open-api.vn/api/p/")
                .then(res => res.json())
                .then(data => {
                    provinceSelect.innerHTML = '<option value="">Chọn tỉnh/thành</option>';
                    data.forEach(p => {
                        let opt = document.createElement("option");
                        opt.value = p.code;
                        opt.textContent = p.name;
                        provinceSelect.appendChild(opt);
                    });
                });
        }

        // Gọi API tính phí ship
        function calculateShipping(provinceCode) {
            return fetch("http://127.0.0.1:8002/api/calculate-shipping", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    province_code: Number(provinceCode)
                })
            }).then(res => res.json());
        }

        // Nút tính phí vận chuyển (ra luôn tổng cộng)
        btnCalculate?.addEventListener("click", function() {
            const provinceCode = provinceSelect.value;
            if (!provinceCode) return alert("Bạn phải chọn tỉnh/thành.");

            calculateShipping(provinceCode)
                .then(data => {

                    const shippingFee = Number(data.shipping_fee);
                    const subtotal = Number(subtotalEl.dataset.value);

                    shippingDisplay.innerText =
                        new Intl.NumberFormat("vi-VN").format(shippingFee) + " đ";

                    const total = subtotal + shippingFee;

                    grandTotalEl.innerText =
                        new Intl.NumberFormat("vi-VN").format(total) + " đ";
                });
        });



        // ============================================================
        // 2) GIỎ HÀNG — UPDATE, DELETE
        // ============================================================

        // Reset mọi event listener bị double
        document.querySelectorAll(
            '.input-counter__plus, .input-counter__minus, .table-p__delete-link, .js-clear-cart, #btnSyncCart'
        ).forEach(btn => btn?.replaceWith(btn.cloneNode(true)));

        // Xóa từng sản phẩm
        document.querySelectorAll('.table-p__delete-link').forEach(btn => {
            btn.addEventListener("click", function() {

                fetch(`${API_CART}/${this.dataset.id}`, {
                        method: "DELETE"
                    })
                    .then(res => res.json())
                    .then(() => location.reload());
            });
        });

        // Hàm cập nhật số lượng
        function updateQuantity(itemId, action) {
            let input = document.querySelector(`input[data-id="${itemId}"]`);
            let qty = Number(input.value);

            if (action === "increase") qty++;
            if (action === "decrease" && qty > 1) qty--;

            input.value = qty;

            fetch(`${API_CART}/update`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        item_id: itemId,
                        quantity: qty
                    })
                })
                .then(res => res.json())
                .then(() => location.reload());
        }

        document.querySelectorAll('.input-counter__plus').forEach(btn => {
            btn.addEventListener("click", () =>
                updateQuantity(btn.dataset.id, "increase")
            );
        });

        document.querySelectorAll('.input-counter__minus').forEach(btn => {
            btn.addEventListener("click", () =>
                updateQuantity(btn.dataset.id, "decrease")
            );
        });


        // ============================================================
        // 3) XÓA TOÀN BỘ GIỎ HÀNG
        // ============================================================

        const clearCartBtn = document.querySelector(".js-clear-cart");

        clearCartBtn?.addEventListener("click", function(e) {
            e.preventDefault();

            if (!confirm("Bạn chắc chắn muốn xóa toàn bộ giỏ hàng?")) return;

            fetch(`${API_CART}/clear-all`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        user_id: USER_ID
                    })
                })
                .then(res => res.json())
                .then(() => location.reload());
        });


        // ============================================================
        // 4) SYNC GIỎ HÀNG
        // ============================================================

        const btnSyncCart = document.getElementById("btnSyncCart");

        btnSyncCart?.addEventListener("click", function(e) {
            e.preventDefault();

            fetch(`${API_CART}/sync`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        user_id: USER_ID
                    })
                })
                .then(res => res.json())
                .then(() => {
                    alert("Giỏ hàng đã được cập nhật.");
                    location.reload();
                });
        });

    });
</script>


@endsection

{{-- 4. Kết thúc phần nội dung --}}