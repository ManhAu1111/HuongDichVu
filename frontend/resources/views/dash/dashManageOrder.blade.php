{{-- 1. Kế thừa file layout chính --}}
@extends('layouts.app')

{{-- 2. Đặt tiêu đề riêng cho trang này (sẽ thay thế @yield('title')) --}}
{{-- Trong thực tế, bạn sẽ dùng biến động: @section('title', $post->title) --}}
@section('title', 'Ludus - Chi Tiết Bài Viết')


{{-- 3. Bắt đầu phần nội dung (sẽ thay thế @yield('content')) --}}
@section('content')
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

                                <a href="{{ route('dashboard') }}">Tài Khoản Của Tôi</a>
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
                            <h1 class="dash__h1 u-s-m-b-30">Chi tiết đơn hàng</h1>

                            <!-- THÔNG TIN ĐƠN -->
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                <div class="dash__pad-2">
                                    <div class="dash-l-r">
                                        <div>
                                            <div class="manage-o__text-2 u-c-secondary">Mã đơn: <span
                                                    id="order-code">#305423126</span></div>
                                            <div class="manage-o__text u-c-silver">
                                                Ngày đặt: <span id="order-date">26/10/2016 09:08:37</span>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="manage-o__text-2 u-c-silver">Tổng tiền:
                                                <span class="manage-o__text-2 u-c-secondary" id="order-total">16.00
                                                    đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DANH SÁCH SẢN PHẨM TRONG ĐƠN -->
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                <div class="dash__pad-2">
                                    <div class="manage-o">
                                        <div class="manage-o__header u-s-m-b-30">
                                            <div class="manage-o__icon">
                                                <i class="fas fa-box u-s-m-r-5"></i>
                                                <span class="manage-o__text">Sản phẩm</span>
                                            </div>
                                        </div>

                                        <!-- TIẾN TRÌNH ĐƠN HÀNG -->
                                        <div class="dash-l-r">
                                            <div class="manage-o__text u-c-secondary">Trạng thái giao hàng: <span
                                                    id="order-status">Đang xử lý</span></div>
                                            <div class="manage-o__icon">
                                                <i class="fas fa-truck u-s-m-r-5"></i>
                                                <span class="manage-o__text">Giao hàng tiêu chuẩn</span>
                                            </div>
                                        </div>
                                        <!-- timeline -->
                                        <style>
                                            .timeline-track {
                                                position: relative;
                                                display: flex;
                                                justify-content: space-between;
                                                align-items: center;
                                                width: 100%;
                                                padding: 25px 0 10px;
                                                margin-bottom: 15px;
                                            }

                                            /* Line xám */
                                            .timeline-track::before {
                                                content: "";
                                                position: absolute;
                                                top: 28px;
                                                left: 0;
                                                width: 100%;
                                                height: 3px;
                                                background-color: #e5e5e5;
                                                z-index: 1;
                                            }

                                            .timeline-step {
                                                text-align: center;
                                                width: 33.33%;
                                                position: relative;
                                                z-index: 2;
                                            }

                                            /* MẶC ĐỊNH: node chưa active */
                                            .timeline-square {
                                                width: 18px;
                                                height: 18px;
                                                background: white;
                                                border: 3px solid #bbb;
                                                border-radius: 3px;
                                                display: inline-block;
                                                transition: 0.2s;
                                            }

                                            /* COMPLETED: full tím */
                                            .timeline-step.completed .timeline-square {
                                                background-color: #7b61ff;
                                                border-color: #7b61ff;
                                            }

                                            /* ACTIVE: nền tím đậm hơn, border tím */
                                            .timeline-step.active .timeline-square {
                                                background-color: #7b61ff;
                                                border-color: #7b61ff;
                                                transform: scale(1.05);
                                            }

                                            /* Line trước node chuyển tím khi completed hoặc active */
                                            .timeline-step.completed::before,
                                            .timeline-step.active::before {
                                                content: "";
                                                position: absolute;
                                                top: 28px;
                                                left: -50%;
                                                width: 100%;
                                                height: 3px;
                                                background-color: #7b61ff;
                                                z-index: -1;
                                            }

                                            .timeline-step:first-child::before {
                                                display: none;
                                            }

                                            .timeline-text {
                                                margin-top: 8px;
                                                font-size: 14px;
                                                font-weight: 600;
                                                color: #333;
                                                letter-spacing: 0.5px;
                                            }
                                        </style>


                                        <div class="manage-o__timeline">
                                            <div class="timeline-track">

                                                <div class="timeline-step" id="step-1">
                                                    <div class="timeline-l-i">
                                                        <span class="timeline-square"></span>
                                                    </div>
                                                    <span class="timeline-text">ĐANG XỬ LÝ</span>
                                                </div>

                                                <div class="timeline-step" id="step-2">
                                                    <div class="timeline-l-i">
                                                        <span class="timeline-square"></span>
                                                    </div>
                                                    <span class="timeline-text">ĐANG GIAO</span>
                                                </div>

                                                <div class="timeline-step" id="step-3">
                                                    <div class="timeline-l-i">
                                                        <span class="timeline-square"></span>
                                                    </div>
                                                    <span class="timeline-text">ĐÃ GIAO</span>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- SẢN PHẨM -->
                                        <div id="order-items">
                                            <!-- Dữ liệu sẽ được render bằng JS -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- THÔNG TIN VẬN CHUYỂN & TÓM TẮT -->

                            <style>
                                /* Khối thông tin nhận hàng */
                                .info-row {
                                    display: flex;
                                    justify-content: space-between;
                                    margin-bottom: 8px;
                                }

                                .info-label {
                                    font-size: 14px;
                                    font-weight: 500;
                                    color: #555;
                                    width: 40%;
                                }

                                .info-value {
                                    width: 60%;
                                    text-align: right;
                                    color: #222;
                                    font-size: 15px;
                                    font-weight: 600;
                                    word-break: break-word;
                                }

                                /* Khối tổng kết đơn hàng */
                                .summary-row {
                                    display: flex;
                                    justify-content: space-between;
                                    margin-bottom: 8px;
                                }

                                .summary-label {
                                    font-size: 14px;
                                    color: #555;
                                    font-weight: 500;
                                }

                                .summary-value {
                                    font-size: 15px;
                                    font-weight: 600;
                                    color: #222;
                                    text-align: right;
                                }
                            </style>

                            <div class="row">

                                <!-- SHIPPING ADDRESS -->
                                <div class="col-lg-6">
                                    <div class="dash__box dash__box--bg-white dash__box--shadow u-h-100">
                                        <div class="dash__pad-3">

                                            <h2 class="dash__h2 u-s-m-b-16">Thông tin nhận hàng</h2>

                                            <div class="info-row">
                                                <div class="info-label">Tên người nhận:</div>
                                                <div class="info-value" id="receiver-name"></div>
                                            </div>

                                            <div class="info-row">
                                                <div class="info-label">Địa chỉ giao hàng:</div>
                                                <div class="info-value" id="receiver-address"></div>
                                            </div>

                                            <div class="info-row">
                                                <div class="info-label">Số điện thoại:</div>
                                                <div class="info-value" id="receiver-phone"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- SUMMARY -->
                                <div class="col-lg-6">
                                    <div class="dash__box dash__box--bg-white dash__box--shadow u-h-100">
                                        <div class="dash__pad-3">
                                            <h2 class="dash__h2 u-s-m-b-16">Tổng kết đơn hàng</h2>

                                            <div class="summary-row">
                                                <div class="summary-label">Tạm tính:</div>
                                                <div class="summary-value" id="sum-subtotal"></div>
                                            </div>

                                            <div class="summary-row">
                                                <div class="summary-label">Phí vận chuyển:</div>
                                                <div class="summary-value" id="sum-shipping"></div>
                                            </div>

                                            <div class="summary-row">
                                                <div class="summary-label">Tổng cộng:</div>
                                                <div class="summary-value" id="sum-total"></div>
                                            </div>

                                            <span class="summary-label" id="sum-payment"></span>
                                        </div>
                                    </div>
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

<!-- Chi tiết đơn hàng JS -->
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

        // ================================
        // LẤY PUBLIC_ID TỪ URL
        // ================================
        const orderPublicId = window.location.pathname.split("/").pop();

        const API_ORDERS = "http://127.0.0.1:8002/api/orders";
        const API_ORDER_ITEMS = "http://127.0.0.1:8002/api/order-items";
        const API_PRODUCT = "http://127.0.0.1:8003/products";

        const fmtMoney = v => new Intl.NumberFormat("vi-VN").format(v) + " đ";

        // api tỉnh
        const provinceMap = {
            1: "Hà Nội",
            2: "Hà Giang",
            4: "Cao Bằng",
            6: "Bắc Kạn",
            8: "Tuyên Quang",
            10: "Lào Cai",
            11: "Điện Biên",
            12: "Lai Châu",
            14: "Sơn La",
            15: "Yên Bái",
            17: "Hòa Bình",
            19: "Thái Nguyên",
            20: "Lạng Sơn",
            22: "Quảng Ninh",
            24: "Bắc Giang",
            25: "Phú Thọ",
            26: "Vĩnh Phúc",
            27: "Bắc Ninh",
            30: "Hải Dương",
            31: "Hải Phòng",
            33: "Hưng Yên",
            34: "Thái Bình",
            35: "Hà Nam",
            36: "Nam Định",
            37: "Ninh Bình",
            38: "Thanh Hóa",
            40: "Nghệ An",
            42: "Hà Tĩnh",
            44: "Quảng Bình",
            45: "Quảng Trị",
            46: "Thừa Thiên Huế",
            48: "Đà Nẵng",
            49: "Quảng Nam",
            51: "Quảng Ngãi",
            52: "Bình Định",
            54: "Phú Yên",
            56: "Khánh Hòa",
            58: "Ninh Thuận",
            60: "Bình Thuận",
            62: "Kon Tum",
            64: "Gia Lai",
            66: "Đắk Lắk",
            67: "Đắk Nông",
            68: "Lâm Đồng",
            70: "Bình Phước",
            72: "Tây Ninh",
            74: "Bình Dương",
            75: "Đồng Nai",
            77: "Bà Rịa – Vũng Tàu",
            79: "Hồ Chí Minh",
            80: "Long An",
            82: "Tiền Giang",
            83: "Bến Tre",
            84: "Trà Vinh",
            86: "Vĩnh Long",
            87: "Đồng Tháp",
            89: "An Giang",
            91: "Kiên Giang",
            92: "Cần Thơ",
            93: "Hậu Giang",
            94: "Sóc Trăng",
            95: "Bạc Liêu",
            96: "Cà Mau"
        };

        // ================================
        // SET TIMELINE STATUS
        // ================================
        function setTimelineStatus(status) {
            const map = {
                "pending_payment": 1,
                "paid": 1,
                "processing": 1,
                "delivering": 2,
                "completed": 3
            };

            const step = map[status] ?? 1;

            for (let i = 1; i <= 3; i++) {
                const node = document.getElementById(`step-${i}`);
                node.classList.remove("completed", "active");

                if (i < step) node.classList.add("completed");
                if (i === step) node.classList.add("active");
            }
        }


        // ================================
        // LOAD ORDER
        // ================================
        async function loadOrder() {
            const res = await fetch(`${API_ORDERS}/${orderPublicId}`);
            return await res.json();
        }

        // ================================
        // LOAD ORDER ITEMS
        // ================================
        async function loadOrderItems(orderId) {
            const res = await fetch(`${API_ORDER_ITEMS}?order_id=${orderId}`);
            return await res.json();
        }

        function normalizeImage(url) {
            if (!url) return "/images/default.jpg";

            url = url.replace(/\\/g, "/");

            // Nếu url đã bắt đầu bằng http thì giữ nguyên
            if (url.startsWith("http")) return url;

            // Nếu không bắt đầu bằng "/" → thêm "/"
            if (!url.startsWith("/")) {
                url = "/" + url;
            }

            return url;
        }


        // ================================
        // LOAD PRODUCT IMAGE
        // ================================
        async function getProductImage(product_id) {
            try {
                const res = await fetch(`${API_PRODUCT}/${product_id}/primary-image`);
                const data = await res.json();

                if (!data.image_url) return "/images/default.jpg";

                return normalizeImage(data.image_url);

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


        // ================================
        // RENDER PAGE
        // ================================
        async function renderPage() {

            const order = await loadOrder();
            const items = await loadOrderItems(order.id);

            setTimelineStatus(order.status);

            // cập nhật text trạng thái giao hàng
            const statusMap = {
                pending_payment: "Chờ thanh toán",
                paid: "Đang xử lý",
                processing: "Đang xử lý",
                delivering: "Đang giao",
                completed: "Đã giao",
                cancelled: "Đã hủy"
            };

            document.getElementById("order-status").innerText =
                statusMap[order.status] || order.status;

            // HEADER
            document.getElementById("order-code").innerText = "#" + order.public_id;
            document.getElementById("order-date").innerText =
                new Date(order.created_at).toLocaleString("vi-VN");
            document.getElementById("order-total").innerText =
                fmtMoney(order.total_price);

            // SHIPPING INFO
            const provinceName = provinceMap[order.province_code] || order.province_code;

            document.getElementById("receiver-name").innerText = order.receiver_name;
            document.getElementById("receiver-phone").innerText = order.receiver_phone;
            document.getElementById("receiver-address").innerText =
                `${order.street_address}, ${order.district_name}, ${provinceName}`;

            // SUMMARY
            // SUMMARY (FIXED)
            let subtotal = 0;
            items.forEach(i => subtotal += Number(i.subtotal));

            const totalPrice = Number(order.total_price);
            const shippingFee = totalPrice - subtotal;

            document.getElementById("sum-subtotal").innerText = fmtMoney(subtotal);
            document.getElementById("sum-shipping").innerText = fmtMoney(shippingFee);
            document.getElementById("sum-total").innerText = fmtMoney(totalPrice);

            document.getElementById("sum-payment").innerText =
                order.payment_method === "cod" ?
                "Thanh toán khi nhận hàng (COD)" :
                "Thanh toán MoMo";
            // ================================
            // RENDER ITEMS
            // ================================
            const container = document.getElementById("order-items");
            container.innerHTML = "";

            for (let item of items) {

                const img = await getProductImage(item.product_id);

                container.innerHTML += `
            <div class="manage-o__description u-s-m-b-20">
                <div class="description__container">
                    <div class="description__img-wrap">
                        <img class="u-img-fluid" src="${img}" alt="">
                    </div>
                    <div class="description-title">${item.product_name}</div>
                </div>

                <div class="description__info-wrap">
                    <div>
                        <span class="manage-o__text-2 u-c-silver">Số lượng:
                            <span class="manage-o__text-2 u-c-secondary">${item.quantity}</span>
                        </span>
                    </div>

                    <div>
                        <span class="manage-o__text-2 u-c-silver">Tổng:
                            <span class="manage-o__text-2 u-c-secondary">${fmtMoney(item.subtotal)}</span>
                        </span>
                    </div>
                </div>
            </div>
        `;
            }
        }

        // RUN
        renderPage();
        loadOrderCounts()

    });
</script>


@endsection
{{-- 4. Kết thúc phần nội dung --}}