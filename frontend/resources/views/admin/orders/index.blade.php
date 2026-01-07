@extends('admin.layouts.admin_app')
@section('admin_title', 'Quản Lý Đơn Hàng')
@section('admin_content')
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Quản Lý Đơn Hàng</h1>

            {{-- THANH BỘ LỌC CẬP NHẬT --}}
            {{-- THANH BỘ LỌC CẬP NHẬT: KHOẢNG GIÁ --}}
            <div class="filter-container u-s-m-b-30">
                <div class="row-filter"
                    style="display: flex; flex-wrap: wrap; gap: 15px; background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #eee;">

                    <div class="filter-item" style="flex: 1; min-width: 200px;">
                        <label class="gl-label">TÌM TÊN KHÁCH HÀNG</label>
                        <input class="input-text input-text--primary-style" type="text" id="filter-customer"
                            placeholder="Nhập tên khách...">
                    </div>

                    <div class="filter-item" style="flex: 1; min-width: 150px;">
                        <label class="gl-label">TRẠNG THÁI</label>
                        <select class="select-box select-box--primary-style" id="filter-status">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending_payment">Chờ thanh toán</option>
                            <option value="paid">Đã thanh toán</option>
                            <option value="delivering">Đang giao hàng</option>
                            <option value="completed">Hoàn thành</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>

                    <div class="filter-item" style="flex: 1; min-width: 150px;">
                        <label class="gl-label">TỪ NGÀY</label>
                        <input class="input-text input-text--primary-style" type="date" id="filter-date-start">
                    </div>

                    <div class="filter-item" style="flex: 1; min-width: 150px;">
                        <label class="gl-label">ĐẾN NGÀY</label>
                        <input class="input-text input-text--primary-style" type="date" id="filter-date-end">
                    </div>

                    <div class="filter-item" style="flex: 1; min-width: 120px;">
                        <label class="gl-label">GIÁ TỪ (MIN)</label>
                        <input class="input-text input-text--primary-style" type="number" id="filter-price-min"
                            placeholder="đ">
                    </div>
                    <div class="filter-item" style="flex: 1; min-width: 120px;">
                        <label class="gl-label">ĐẾN GIÁ (MAX)</label>
                        <input class="input-text input-text--primary-style" type="number" id="filter-price-max"
                            placeholder="đ">
                    </div>

                    <div class="filter-item d-flex align-items-end" style="gap: 10px;">
                        <button class="btn btn--e-brand-b-2" id="btn-apply-filter" style="height: 45px;">LỌC</button>
                        <button class="btn btn--e-transparent-brand-b-2" id="btn-reset-filter"
                            style="height: 45px;">RESET</button>
                    </div>
                </div>
            </div>

            {{-- BẢNG DỮ LIỆU --}}
            <div class="dash__table-wrap gl-scroll">
                <table class="dash__table">
                    <thead>
                        <tr>
                            <th>Mã đơn (Public ID)</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thanh toán</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="order-list-body">
                        {{-- Render bằng JS --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const ORDER_API = 'http://127.0.0.1:8007/api/admin/orders'; // Route qua Admin Service

        async function loadOrders() {
            const url = new URL(ORDER_API);

            // Thu thập dữ liệu từ các ô lọc bao gồm cả MIN và MAX giá
            const params = {
                customer_name: document.getElementById('filter-customer').value,
                status: document.getElementById('filter-status').value,
                date_start: document.getElementById('filter-date-start').value,
                date_end: document.getElementById('filter-date-end').value,
                price_min: document.getElementById('filter-price-min').value,
                price_max: document.getElementById('filter-price-max').value // Thêm Max
            };

            // Chỉ gắn tham số vào URL nếu ô đó có giá trị
            Object.keys(params).forEach(key => {
                if (params[key] !== "" && params[key] !== null) {
                    url.searchParams.append(key, params[key]);
                }
            });

            try {
                const res = await fetch(url);
                const orders = await res.json();
                renderOrderTable(orders);
            } catch (err) {
                console.error("Lỗi khi tải đơn hàng:", err);
            }
        }

        function renderOrderTable(orders) {
            const tbody = document.getElementById('order-list-body');
            tbody.innerHTML = orders.map(o => `
                        <tr>
                            <td><strong>${o.public_id}</strong></td>
                            <td>${o.receiver_name}<br><small>${o.receiver_phone}</small></td>
                            <td>${new Date(o.created_at).toLocaleDateString('vi-VN')}</td>
                            <td>${new Intl.NumberFormat('vi-VN').format(o.total_price)}đ</td>
                            <td><span class="manage-o__badge badge--${o.status}">${translateStatus(o.status)}</span></td>
                            <td>${o.payment_method.toUpperCase()}</td>
                            <td>
                                <div class="dash__link dash__link--brand">
                                    <a href="/admin/orders/${o.public_id}">CHI TIẾT</a>
                                </div>
                            </td>
                        </tr>
                    `).join('');
        }

        function translateStatus(s) {
            const map = {
                pending_payment: 'Chờ thanh toán',
                paid: 'Đang xử lý',
                delivering: 'Đang giao',
                completed: 'Hoàn thành',
                cancelled: 'Đã hủy'
            };
            return map[s] || s;
        }

        document.getElementById('btn-reset-filter').onclick = () => {
            document.querySelectorAll('.row-filter input, .row-filter select').forEach(el => el.value = '');
            loadOrders();
        };
        document.getElementById('btn-apply-filter').onclick = loadOrders;
        document.addEventListener('DOMContentLoaded', loadOrders);
    </script>

    <style>
        /* 1. Giảm kích thước chữ và padding cho bảng */
        .dash__table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            /* Giảm font-size tổng thể */
        }

        .dash__table th,
        .dash__table td {
            padding: 10px 8px !important;
            /* Thu hẹp khoảng cách giữa các cột */
            white-space: nowrap;
            /* Ngăn chữ bị xuống dòng làm tăng chiều cao hàng */
            vertical-align: middle;
        }

        /* 2. Ưu tiên cột khách hàng có thể xuống dòng vì tên thường dài */
        .dash__table td:nth-child(2) {
            white-space: normal;
            min-width: 150px;
            line-height: 1.2;
        }

        /* 3. Tùy chỉnh Badge trạng thái nhỏ gọn */
        .manage-o__badge {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 12px;
            display: inline-block;
        }

        /* 4. Mở rộng vùng chứa nếu nằm trong container hẹp */
        .dash__table-wrap {
            overflow-x: auto;
            /* Cho phép cuộn ngang mượt mà trên mobile */
            -webkit-overflow-scrolling: touch;
        }

        /* 5. Định dạng lại cột "Hành động" cho gọn */
        .dash__link--brand a {
            font-weight: 600;
            font-size: 12px;
            text-decoration: underline;
        }
    </style>
@endsection
