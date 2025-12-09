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

                                <a href="{{ route('shop.index') }}">Home</a>
                            </li>
                            <li class="is-marked">

                                <a href="{{ route('dashboard') }}">My Account</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->


    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="dash">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">

                            <!--====== Dashboard Features ======-->
                            <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                <div class="dash__pad-1">

                                    <span id="user-greeting" class="dash__text u-s-m-b-16">Xin chào...</span>
                                    <ul class="dash__f-list">
                                        <li>
                                            <a class="dash-active" href="{{ route('dashboard') }}">Quản lý tài khoản</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dash.my_profile') }}">Hồ sơ cá nhân</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dash.my_order') }}">Đơn hàng của tôi</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w">
                                <div class="dash__pad-1">
                                    <ul class="dash__w-list">
                                        <li>
                                            <div class="dash__w-wrap">
                                                <span class="dash__w-icon dash__w-icon-style-1">
                                                    <i class="fas fa-cart-arrow-down"></i>
                                                </span>
                                                <span class="dash__w-text" id="count-placed">0</span>
                                                <span class="dash__w-name">Đơn đã đặt</span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="dash__w-wrap">
                                                <span class="dash__w-icon dash__w-icon-style-2">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                                <span class="dash__w-text" id="count-cancelled">0</span>
                                                <span class="dash__w-name">Đơn đã hủy</span>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="dash__w-wrap">
                                                <span class="dash__w-icon dash__w-icon-style-3">
                                                    <i class="far fa-heart"></i>
                                                </span>
                                                <span class="dash__w-text">0</span>
                                                <span class="dash__w-name">Danh sách yêu thích</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--====== End - Dashboard Features ======-->
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                <div class="dash__pad-2">
                                    <h1 class="dash__h1 u-s-m-b-14">Quản lý tài khoản</h1>

                                    <span class="dash__text u-s-m-b-30">
                                        Tại Bảng điều khiển Tài khoản, bạn có thể xem tổng quan các hoạt động gần đây
                                        và cập nhật thông tin cá nhân của mình. Chọn một liên kết bên dưới để xem hoặc
                                        chỉnh sửa thông tin.
                                    </span>

                                    <div class="row">
                                        <div class="col-lg-12 u-s-m-b-30">
                                            <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">HỒ SƠ CÁ NHÂN</h2>

                                                    <div class="dash__link dash__link--secondary u-s-m-b-8">
                                                        <a href="{{ route('dash.EditProfile') }}">Chỉnh sửa</a>
                                                    </div>

                                                    <span class="dash__text">John Doe</span>
                                                    <span class="dash__text">johndoe@domain.com</span>

                                                    <div class="dash__link dash__link--secondary u-s-m-t-8">
                                                        <a data-modal="modal" data-modal-id="#dash-newsletter">
                                                            Đăng ký nhận bản tin
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius">
                                <h2 class="dash__h2 u-s-p-xy-20">Đơn hàng gần đây</h2>

                                <div class="dash__table-wrap gl-scroll">
                                    <table class="dash__table">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn</th>
                                                <th>Ngày đặt</th>
                                                <th>Sản phẩm</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="recent-orders"></tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->
</div>
<!--====== End - App Content ======-->

<!--====== Modal Section ======-->
<!--====== Unsubscribe or Subscribe Newsletter ======-->
<div class="modal fade" id="dash-newsletter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal--shadow">
            <div class="modal-body">
                <form class="d-modal__form">
                    <div class="u-s-m-b-15">
                        <h1 class="gl-modal-h1">Newsletter Subscription</h1>

                        <span class="gl-modal-text">I have read and understood</span>

                        <a class="d_modal__link" href="{{ route('dashboard') }}">Ludus Privacy Policy</a>
                    </div>
                    <div class="gl-modal-btn-group">

                        <button class="btn btn--e-brand-b-2" type="submit">SUBSCRIBE</button>

                        <button class="btn btn--e-grey-b-2" type="button" data-dismiss="modal">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--====== Unsubscribe or Subscribe Newsletter ======-->
<!--====== End - Modal Section ======-->
<script>
    document.addEventListener("DOMContentLoaded", async function() {

        // ===============================
        // LẤY TOKEN TỪ COOKIE
        // ===============================
        function getCookie(name) {
            const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? match[2] : null;
        }

        const token = getCookie("auth_token");

        // ===============================
        // XỬ LÝ HIỂN THỊ TÊN NGƯỜI DÙNG
        // ===============================
        const greeting = document.getElementById("user-greeting");

        if (!token) {
            greeting.innerHTML = "Hello, Guest";
        } else {
            try {
                const res = await fetch("http://127.0.0.1:8001/me", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token
                    }
                });

                const data = await res.json();

                if (data.ok && data.data.fullname) {
                    greeting.innerHTML = `Hello, ${data.data.fullname}`;
                } else {
                    greeting.innerHTML = "Hello, User";
                }
            } catch (err) {
                greeting.innerHTML = "Hello, User";
            }
        }

        // ===============================
        // LẤY USER ID TỪ JWT
        // ===============================
        function getUserIdFromJWT() {
            if (!token) return null;
            try {
                const payload = JSON.parse(atob(token.split(".")[1]));
                return payload.sub;
            } catch {
                return null;
            }
        }

        const USER_ID = getUserIdFromJWT();
        const API_ORDERS = "http://127.0.0.1:8002/api/orders";

        // ===============================
        // FORMAT TIỀN
        // ===============================
        function fmtMoney(v) {
            return new Intl.NumberFormat("vi-VN").format(v) + " đ";
        }

        // ===============================
        // TẢI DANH SÁCH ĐƠN GẦN NHẤT
        // ===============================
        async function loadRecentOrders() {
            if (!USER_ID) return;

            const res = await fetch(`${API_ORDERS}?user_id=${USER_ID}`);
            const orders = await res.json();

            renderOrders(orders);
        }

        async function loadOrderCounts() {
            const res = await fetch(`${API_ORDERS}?user_id=${USER_ID}`);
            const orders = await res.json();

            // Đơn đã đặt = tất cả đơn TRỪ trạng thái cancelled/draft/pending_payment
            const placed = orders.filter(o => ["processing", "delivering", "completed", "paid",
                "pending_payment"
            ].includes(o
                .status)).length;

            // Đơn đã hủy
            const cancelled = orders.filter(o => o.status === "cancelled").length;

            // Inject vào DOM
            document.getElementById("count-placed").innerText = placed;
            document.getElementById("count-cancelled").innerText = cancelled;
        }


        // ===============================
        // RENDER HTML
        // ===============================
        async function renderOrders(orders) {
            const tbody = document.getElementById("recent-orders");
            tbody.innerHTML = "";

            if (!orders.length) {
                tbody.innerHTML = `<tr><td colspan="4">Bạn chưa có đơn hàng nào.</td></tr>`;
                return;
            }

            for (const order of orders) {

                // 1) Lấy items của đơn hàng
                const itemsRes = await fetch(`http://127.0.0.1:8002/api/order-items?order_id=${order.id}`);
                const items = await itemsRes.json();
                const firstItem = items[0];

                let img = "/images/default.jpg";

                // 2) Lấy ảnh từ product_service
                if (firstItem) {
                    const imgRes = await fetch(
                        `http://127.0.0.1:8003/products/${firstItem.product_id}/primary-image`);
                    const imgData = await imgRes.json();

                    if (imgData.image_url) {
                        img = imgData.image_url.replace("\\", "/");
                    }
                }

                tbody.innerHTML += `
            <tr>
                <td>${order.public_id}</td>
                <td>${new Date(order.created_at).toLocaleDateString("vi-VN")}</td>
                <td>
                    <div class="dash__table-img-wrap">
                        <img class="u-img-fluid" src="${img}" alt="">
                    </div>
                </td>
                <td>
                    <div class="dash__table-total">
                        <span>${fmtMoney(order.total_price)}</span>
                        <div class="dash__link dash__link--brand">
                            <a href="/dashManageOrder/${order.public_id}">XEM CHI TIẾT</a>
                        </div>
                    </div>
                </td>
            </tr>
        `;
            }
        }

        // RUN
        loadRecentOrders();
        loadOrderCounts();
    });
</script>


@endsection
{{-- 4. Kết thúc phần nội dung --}}