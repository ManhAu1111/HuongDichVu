@extends('layouts.app')

@section('title', 'Ludus - Đơn hàng của tôi')

@section('content')
<div class="app-content">

    <!--====== Section 1 (Breadcrumb) ======-->
    <div class="u-s-p-y-60">
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">
                                <a href="{{ route('shop.index') }}">Home</a>
                            </li>
                            <li class="is-marked">
                                <a href="{{ route('dash.my_order') }}">My Orders</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== Section 2 (My Orders) ======-->
    <div class="u-s-p-b-60">
        <div class="section__content">
            <div class="dash">
                <div class="container">
                    <div class="row">

                        <!-- LEFT MENU -->
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


                        <!-- RIGHT CONTENT -->
                        <div class="col-lg-9 col-md-12">
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                <div class="dash__pad-2">

                                    <h1 class="dash__h1 u-s-m-b-14">Đơn hàng của tôi</h1>
                                    <span class="dash__text u-s-m-b-30">Danh sách tất cả đơn hàng của bạn</span>

                                    <!-- LIST WRAPPER -->
                                    <div id="orders-list" class="m-order__list">
                                        <!-- JS sẽ render toàn bộ danh sách vào đây -->
                                        <div>Đang tải đơn hàng...</div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- ============================= -->
<!--  JAVASCRIPT LOAD USER ORDERS  -->
<!-- ============================= -->
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
        const API_ORDER_ITEMS = "http://127.0.0.1:8002/api/order-items";
        const API_PRODUCT = "http://127.0.0.1:8003/products";

        const fmtMoney = v => new Intl.NumberFormat("vi-VN").format(v) + " đ";

        const listEl = document.getElementById("orders-list");


        // Load danh sách đơn hàng
        async function loadOrders() {
            if (!USER_ID) {
                listEl.innerHTML = "<div>Không xác định được người dùng.</div>";
                return;
            }

            const res = await fetch(`${API_ORDERS}?user_id=${USER_ID}`);
            const orders = await res.json();

            renderOrders(orders);
        }

        const statusMap = {
            pending_payment: "Đang xử lý",
            paid: "Đang xử lý",
            delivering: "Đang giao",
            completed: "Đã giao",
            cancelled: "Đã hủy",
            draft: "Nháp"
        };

        function getStatusBadgeClass(statusRaw) {
            const status = statusRaw?.trim().toLowerCase();

            switch (status) {
                case "pending_payment":
                case "paid":
                    return "badge--processing";
                case "delivering":
                    return "badge--shipping";
                case "completed":
                    return "badge--delivered";
                case "cancelled":
                    return "badge--cancelled";
                default:
                    return "badge--processing";
            }
        }



        // Lấy ảnh sản phẩm đầu tiên trong đơn
        async function loadFirstProductImage(order_id) {
            try {
                const res = await fetch(`${API_ORDER_ITEMS}?order_id=${order_id}`);
                const items = await res.json();

                if (!items.length) return "/images/default.jpg";

                const first = items[0];

                const imgRes = await fetch(`${API_PRODUCT}/${first.product_id}/primary-image`);
                const imgData = await imgRes.json();

                if (!imgData.image_url) return "/images/default.jpg";

                // GIỐNG HỆT DASHBOARD
                return imgData.image_url.replace("\\", "/");

            } catch {
                return "/images/default.jpg";
            }
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

        // Render danh sách đơn
        async function renderOrders(orders) {
            listEl.innerHTML = "";

            if (!orders.length) {
                listEl.innerHTML = "<div>Bạn chưa có đơn hàng nào.</div>";
                return;
            }

            for (const order of orders) {

                // 1) Lấy ảnh
                const img = await loadFirstProductImage(order.id);

                // 2) Tính tổng số lượng từ API order-items
                const itemsRes = await fetch(`${API_ORDER_ITEMS}?order_id=${order.id}`);
                const items = await itemsRes.json();
                const totalQty = items.reduce((sum, i) => sum + Number(i.quantity), 0);

                // 3) Chuyển trạng thái sang tiếng Việt
                const cleanStatus = order.status?.trim().toLowerCase();
                const vnStatus = statusMap[cleanStatus] ?? order.status;

                // 4) Tạo thẻ đơn hàng
                listEl.innerHTML += `
    <style>
        .manage-o__badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
        }

        .badge--processing {
            background-color: rgba(123, 97, 255, 0.15);
            color: #7b61ff;
            border: 1px solid rgba(123, 97, 255, 0.35);
        }

        .badge--shipping {
            background-color: rgba(0, 174, 255, 0.15);
            color: #0093dd;
            border: 1px solid rgba(0, 174, 255, 0.35);
        }

        .badge--delivered {
            background-color: rgba(40, 167, 69, 0.15);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.35);
        }

        .badge--cancelled {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.35);
        }
    </style>

    <div class="m-order__get">
        <div class="manage-o__header u-s-m-b-30">
            <div class="dash-l-r">
                <div>
                    <div class="manage-o__text-2 u-c-secondary">Mã đơn: ${order.public_id}</div>
                    <div class="manage-o__text u-c-silver">
                        Ngày đặt: ${new Date(order.created_at).toLocaleDateString("vi-VN")}
                    </div>
                </div>

                <div>
                    <div class="dash__link dash__link--brand">
                        <a href="/dashManageOrder/${order.public_id}">XEM CHI TIẾT</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="manage-o__description">
            <div class="description__container">
                <div class="description__img-wrap">
                    <img class="u-img-fluid" src="${img}" alt="">
                </div>
                <div class="description-title">
                    Số lượng sản phẩm: ${totalQty}
                </div>
            </div>

            <div class="description__info-wrap">
                <div>
                    <span class="manage-o__badge ${getStatusBadgeClass(order.status)}">
                        ${vnStatus}
                    </span>
                </div>

                <div>
                    <span class="manage-o__text-2 u-c-silver">Tổng:
                        <span class="manage-o__text-2 u-c-secondary">${fmtMoney(order.total_price)}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
`;

            }
        }
        // RUN
        loadOrders();
        loadOrderCounts();
    });
</script>

@endsection