{{-- 1. Kế thừa file layout chính --}}
@extends('layouts.app')

{{-- 2. Đặt tiêu đề riêng cho trang này (sẽ thay thế @yield('title')) --}}
{{-- Trong thực tế, bạn sẽ dùng biến động: @section('title', $post->title) --}}
@section('title', 'Ludus - Chi Tiết Bài Viết')

{{-- 3. Bắt đầu phần nội dung (sẽ thay thế @yield('content')) --}}
@section('content')
<!--====== App Content ======-->
<div class="app-content">

    <!--====== Section 1 ======-->
    <div class="u-s-p-y-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">

                                <a href="{{ route('shop.index') }}">Trang Chủ</a>
                            </li>
                            <li class="is-marked">

                                <a href="{{ route('checkout') }}">Thanh Toán</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->

    <!--====== Section 3 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="checkout-f">
                    <div class="row">
                        <!-- DELIVERY INFORMATION -->
                        <!-- DELIVERY INFORMATION -->
                        <div class="col-lg-6">
                            <h1 class="checkout-f__h1">THÔNG TIN GIAO HÀNG</h1>

                            <form class="checkout-f__delivery" id="checkoutDeliveryForm" onsubmit="return false;">
                                <div class="u-s-m-b-30">

                                    <!-- <div class="u-s-m-b-15">
                                        <div class="check-box">
                                            <input type="checkbox" id="use-default-address">
                                            <div class="check-box__state check-box__state--primary">
                                                <label class="check-box__label" for="use-default-address">Dùng địa chỉ
                                                    mặc định từ tài khoản</label>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="gl-inline">
                                        <div class="u-s-m-b-15">
                                            <label class="gl-label" for="receiver_name">Họ và tên *</label>
                                            <input class="input-text input-text--primary-style" type="text"
                                                id="receiver_name" name="receiver_name" required>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <label class="gl-label" for="receiver_phone">Số điện thoại *</label>
                                            <input class="input-text input-text--primary-style" type="text"
                                                id="receiver_phone" name="receiver_phone" required>
                                        </div>
                                    </div>

                                    <div class="u-s-m-b-15">
                                        <label class="gl-label" for="receiver_email">E-mail *</label>
                                        <input class="input-text input-text--primary-style" type="email"
                                            id="receiver_email" name="receiver_email" required>
                                    </div>

                                    <div class="u-s-m-b-15">
                                        <label class="gl-label" for="street_address">Địa chỉ (số nhà, đường) *</label>
                                        <input class="input-text input-text--primary-style" type="text"
                                            id="street_address" name="street_address" placeholder="Số nhà, tên đường"
                                            required>
                                    </div>

                                    <!-- Tỉnh / Thành -->
                                    <div class="u-s-m-b-15">
                                        <label class="gl-label" for="province-select">Tỉnh/Thành *</label>
                                        <select class="select-box select-box--primary-style" id="province-select"
                                            required>
                                            <option value="">Chọn tỉnh/thành</option>
                                        </select>
                                    </div>

                                    <!-- Quận / Huyện -->
                                    <div class="u-s-m-b-15">
                                        <label class="gl-label" for="district-select">Quận/Huyện *</label>
                                        <select class="select-box select-box--primary-style" id="district-select"
                                            required disabled>
                                            <option value="">Chọn quận/huyện</option>
                                        </select>
                                    </div>


                                    <!-- (bỏ zip_code theo quyết định của cậu) -->

                                    <div class="u-s-m-b-10">
                                        <label class="gl-label" for="order_note">Ghi chú đơn hàng (tùy chọn)</label>
                                        <textarea class="text-area text-area--primary-style" id="order_note"
                                            name="order_note"></textarea>
                                    </div>

                                    <div>
                                        <button class="btn btn--e-transparent-brand-b-2" type="button"
                                            id="btnSaveDelivery">Lưu thông tin</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6">
                            <h1 class="checkout-f__h1">THÔNG TIN ĐƠN HÀNG</h1>

                            <!--====== Order Summary ======-->
                            <div class="o-summary">
                                <div class="o-summary__section u-s-m-b-30">
                                    <div class="o-summary__item-wrap gl-scroll">
                                        <div class="o-card" data-product-id="1">
                                            <div class="o-card__flex">
                                                <div class="o-card__img-wrap">

                                                    <img class="u-img-fluid"
                                                        src="images/product/electronic/product3.jpg" alt="">
                                                </div>
                                                <div class="o-card__info-wrap">

                                                    <span class="o-card__name">

                                                        <a href="#">Yellow Wireless
                                                            Headphone</a></span>

                                                    <span class="o-card__quantity">Quantity x 1</span>

                                                    <span class="o-card__price">0 đ</span>
                                                </div>
                                            </div>

                                            <a class="o-card__del far fa-trash-alt"></a>
                                        </div>

                                        <div class="o-card" data-product-id="2">
                                            <div class="o-card__flex">
                                                <div class="o-card__img-wrap">

                                                    <img class="u-img-fluid"
                                                        src="images/product/electronic/product18.jpg" alt="">
                                                </div>
                                                <div class="o-card__info-wrap">

                                                    <span class="o-card__name">

                                                        <a href="#">Nikon DSLR
                                                            Camera
                                                            4k</a>
                                                    </span>


                                                    <span class="o-card__quantity">Quantity x 1</span>

                                                    <span class="o-card__price">0 đ</span>
                                                </div>
                                            </div>

                                            <a class="o-card__del far fa-trash-alt"></a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="o-summary__section u-s-m-b-30">
                        <div class="o-summary__box">
                            <!-- Tổng tiền -->
                            <table class="o-summary__table">
                                <tbody>
                                    <tr>
                                        <td>PHÍ GIAO HÀNG</td>
                                        <td id="shipping-fee-display" data-value="0">0 đ</td>
                                    </tr>
                                    <tr>
                                        <td>TẠM TÍNH</td>
                                        <td id="subtotal-display" data-value="0">0 đ</td>
                                    </tr>
                                    <tr>
                                        <td><strong>TỔNG CỘNG</strong></td>
                                        <td id="grand-total-display">0 đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="o-summary__section u-s-m-b-30">
                        <div class="o-summary__box">
                            <h1 class="checkout-f__h1"><strong>THÔNG TIN THANH TOÁN</strong>
                            </h1>
                            <form class="payment-form" id="checkoutForm" method="POST">
                                <div class="u-s-m-b-10">
                                    <div class="radio-box">
                                        <input type="radio" id="cash-on-delivery" name="payment" value="cod">
                                        <div class="radio-box__state radio-box__state--primary">
                                            <label class="radio-box__label" for="cash-on-delivery">
                                                Thanh toán khi nhận hàng (COD)
                                            </label>
                                        </div>
                                    </div>

                                    <span class="gl-text u-s-m-t-6">
                                        Bạn thanh toán trực tiếp cho nhân viên giao hàng khi nhận được
                                        sản
                                        phẩm.
                                    </span>
                                </div>

                                <div class="u-s-m-b-10">
                                    <div class="radio-box">
                                        <input type="radio" id="momo-wallet" name="payment" value="momo">
                                        <div class="radio-box__state radio-box__state--primary">
                                            <label class="radio-box__label" for="momo-wallet">
                                                Thanh toán bằng Ví MoMo
                                            </label>
                                        </div>
                                    </div>

                                    <span class="gl-text u-s-m-t-6">
                                        Bạn sẽ được chuyển hướng sang Ví MoMo để thực hiện thanh toán an
                                        toàn và nhanh chóng.
                                    </span>
                                </div>

                                <div class="u-s-m-b-15">
                                    <div class="check-box">
                                        <input type="checkbox" id="term-and-condition">
                                        <div class="check-box__state check-box__state--primary">
                                            <label class="check-box__label" for="term-and-condition">
                                                Tôi đồng ý với
                                            </label>
                                        </div>
                                    </div>
                                    <a class="gl-link">Điều khoản dịch vụ.</a>
                                </div>
                                <div>
                                    <button class="btn btn--e-brand-b-2" type="submit">ĐẶT HÀNG</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
                <!--====== End - Order Summary ======-->
            </div>
        </div>
    </div>
</div>
</div>
<!--====== End - Section Content ======-->
</div>
<!--====== End - Section 3 ======-->
</div>
<!--====== End - App Content ======-->

<!--====== End - Shipping Address Add Modal ======-->


<!--====== End - Modal Section ======-->
<!-- Thanh toán - Xử lý Momo -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const provinceSelect = document.getElementById('province-select');
        const districtSelect = document.getElementById('district-select');
        const btnSaveDelivery = document.getElementById('btnSaveDelivery');
        const formCheckout = document.getElementById('checkoutForm');
        const shippingDisplay = document.getElementById('shipping-fee-display');
        const subtotalEl = document.getElementById('subtotal-display');
        const grandTotalEl = document.getElementById('grand-total-display');
        const taxDisplay = document.getElementById('tax-display');

        districtSelect.disabled = true;

        // ===========================
        // Load PROVINCES
        // ===========================
        fetch("https://provinces.open-api.vn/api/p/")
            .then(r => r.json())
            .then(data => {
                provinceSelect.innerHTML = '<option value="">Chọn tỉnh/thành</option>';
                data.forEach(p => {
                    const opt = document.createElement("option");
                    opt.value = p.code;
                    opt.textContent = p.name;
                    provinceSelect.appendChild(opt);
                });
            });

        // Load DISTRICTS
        provinceSelect.addEventListener("change", function() {
            const provinceCode = this.value;

            districtSelect.innerHTML = '<option value="">Chọn quận/huyện</option>';
            districtSelect.disabled = true;

            if (!provinceCode) return;

            fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
                .then(r => r.json())
                .then(data => {
                    data.districts.forEach(d => {
                        const opt = document.createElement("option");
                        opt.value = d.code;
                        opt.textContent = d.name;
                        districtSelect.appendChild(opt);
                    });
                    districtSelect.disabled = false;
                });
        });

        const fmt = v => new Intl.NumberFormat("vi-VN").format(v) + " đ";

        // ===========================
        // JWT
        // ===========================
        function getCookie(name) {
            const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? match[2] : null;
        }

        function getUserIdFromJWT() {
            const token = getCookie("auth_token");
            if (!token) return null;

            try {
                const payload = JSON.parse(atob(token.split(".")[1]));
                return payload.sub;
            } catch {
                return null;
            }
        }

        // ===========================
        // SUBTOTAL
        // ===========================
        function computeSubtotalFromDOM() {
            let subtotal = 0;

            document.querySelectorAll(".o-card").forEach(card => {
                const price = parseInt(card.querySelector(".o-card__price").textContent.replace(/[^0-9]/g,
                    "")) || 0;
                const qty = parseInt(card.querySelector(".o-card__quantity").textContent.match(
                    /x\s*([0-9]+)/)[1]);

                subtotal += price * qty;
            });

            subtotalEl.dataset.value = subtotal;
            subtotalEl.innerText = fmt(subtotal);

            updateGrandTotal();
        }

        function updateGrandTotal() {
            const subtotal = Number(subtotalEl.dataset.value || 0);
            const ship = Number(shippingDisplay.dataset.value || 0);
            const tax = Number(taxDisplay.dataset.value || 0);

            grandTotalEl.innerText = fmt(subtotal + ship + tax);
        }

        computeSubtotalFromDOM();

        // ===========================
        // API tính phí ship
        // ===========================
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

        btnSaveDelivery.addEventListener("click", function() {
            const provinceCode = provinceSelect.value;
            if (!provinceCode) return alert("Vui lòng chọn tỉnh.");

            calculateShipping(provinceCode)
                .then(data => {
                    const fee = Number(data.shipping_fee || 0);
                    shippingDisplay.dataset.value = fee;
                    shippingDisplay.innerText = fmt(fee);
                    updateGrandTotal();
                })
                .catch(() => alert("Không tính được phí giao hàng."));
        });

        // ===========================
        // SUBMIT CHECKOUT
        // ===========================
        formCheckout.addEventListener("submit", async function(e) {
            e.preventDefault();

            const paymentMethod = document.querySelector('input[name="payment"]:checked');
            if (!paymentMethod) return alert("Vui lòng chọn phương thức thanh toán.");

            if (!document.getElementById("term-and-condition").checked)
                return alert("Bạn phải đồng ý điều khoản.");

            const receiver_name = document.getElementById("receiver_name").value.trim();
            const receiver_phone = document.getElementById("receiver_phone").value.trim();
            const receiver_email = document.getElementById("receiver_email").value.trim();
            const street_address = document.getElementById("street_address").value.trim();
            const district_code = districtSelect.value;
            const province_code = provinceSelect.value;

            if (!receiver_name || !receiver_phone || !receiver_email || !street_address || !
                district_code || !province_code) {
                return alert("Vui lòng nhập đầy đủ thông tin giao hàng.");
            }

            const items = [];
            document.querySelectorAll(".o-card").forEach(card => {
                items.push({
                    product_id: Number(card.dataset.productId),
                    product_name: card.querySelector(".o-card__name a").textContent
                        .trim(),
                    price: parseInt(card.querySelector(".o-card__price").textContent
                        .replace(/[^0-9]/g, "")),
                    quantity: parseInt(card.querySelector(".o-card__quantity")
                        .textContent.match(/x\s*([0-9]+)/)[1])
                });
            });

            const userId = getUserIdFromJWT();
            if (!userId) return alert("Bạn phải đăng nhập trước khi đặt hàng!");

            const payloadBase = {
                user_id: userId,
                receiver_name,
                receiver_phone,
                receiver_email,
                street_address,
                district_name: districtSelect.options[districtSelect.selectedIndex].textContent,
                province_code: Number(province_code),
                items,
                shipping_fee: Number(shippingDisplay.dataset.value || 0),
                amount: Number(grandTotalEl.innerText.replace(/[^0-9]/g, ""))
            };

            // ===========================
            // COD
            // ===========================
            if (paymentMethod.value === "cod") {
                const res = await fetch("http://127.0.0.1:8002/api/checkout", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        ...payloadBase,
                        payment_method: "cod"
                    })
                });

                const data = await res.json();
                alert("Đặt hàng COD thành công. Mã đơn: " + data.order_id);
                return;
            }

            // ===========================
            // MOMO FLOW (CHUẨN)
            // ===========================
            if (paymentMethod.value === "momo") {
                const momoRes = await fetch("http://127.0.0.1:8004/api/momo/create", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(payloadBase)
                });

                const momoData = await momoRes.json();

                if (!momoData.payUrl) {
                    alert("Không nhận được payUrl từ MoMo.");
                    console.error(momoData);
                    return;
                }

                // Redirect sang MoMo
                window.location.href = momoData.payUrl;
            }

        });

    });
</script>



<!--====== End - Shipping Address Add Modal ======-->
<!--====== End - Modal Section ======-->

@endsection
{{-- 4. Kết thúc phần nội dung --}}