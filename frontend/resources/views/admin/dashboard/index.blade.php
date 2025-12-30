@extends('admin.layouts.admin_app')

@section('admin_title', 'Tổng Quan Quản Trị')

@section('admin_content')

    {{-- Thêm thư viện Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">BÁO CÁO CỬA HÀNG</h1>

            <div class="row">
                {{-- Widget Doanh thu động: Sẽ cập nhật khi biểu đồ thay đổi --}}
                <div class="col-lg-4 col-md-6 u-s-m-b-30">
                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                        <div class="dash__pad-3">
                            <div class="dash__w-wrap"
                                style="display: flex; flex-direction: column;">
                                <span class="dash__w-icon dash__w-icon-style-1">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </span>
                                <span class="dash__w-text" id="dynamic-revenue">0 đ</span>
                                <span class="dash__w-name" id="revenue-period-label">Tổng doanh thu (30 ngày)</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Widget Đơn hàng--}}
                <div class="col-lg-4 col-md-6 u-s-m-b-30">
                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                        <div class="dash__pad-3">
                            <div class="dash__w-wrap">
                                <span class="dash__w-icon dash__w-icon-style-2"><i class="fas fa-clock"></i></span>
                                <span class="dash__w-text" id="stat-pending-count">0</span>
                                <span class="dash__w-name">Đơn hàng chờ xử lý</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Widget Kho--}}
                <div class="col-lg-4 col-md-6 u-s-m-b-30">
                    <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                        <div class="dash__pad-3">
                            <div class="dash__w-wrap">
                                <span class="dash__w-icon dash__w-icon-style-3"><i
                                        class="fas fa-exclamation-triangle"></i></span>
                                {{-- ID: stat-low-stock-count --}}
                                <span class="dash__w-text" id="stat-low-stock-count">0</span>
                                <span class="dash__w-name">Sản phẩm sắp hết hàng</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Khối Biểu đồ Doanh thu --}}
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <div class="d-flex justify-content-between align-items-center u-s-m-b-20">
                <h2 class="dash__h2">BIỂU ĐỒ DOANH THU CHI TIẾT</h2>
                <select class="select-box select-box--primary-style" id="chart-filter" style="width: 250px;">
                    <option value="10">10 ngày gần nhất</option>
                    <option value="30" selected>30 ngày gần nhất</option>
                    <option value="60">60 ngày gần nhất</option>
                </select>
            </div>
            <div style="height: 400px; position: relative;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Cột Trái: Đơn hàng gần đây --}}
        <div class="col-lg-8">
            <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius u-s-m-b-30">
                <h2 class="dash__h2 u-s-p-xy-20">ĐƠN HÀNG GẦN ĐÂY</h2>
                <div class="dash__table-wrap gl-scroll">
                    <table class="dash__table">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="recent-orders-body">
                            <tr>
                                <td>#order_6950ef06</td>
                                <td>Âu Mạnh</td>
                                <td><span class="manage-o__badge badge--delivered">Đã giao</span></td>
                                <td>1.485.825 đ</td>
                                <td>
                                    <div class="dash__link dash__link--brand"><a href="#">CHI TIẾT</a></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Cột Phải: Cảnh báo kho --}}
        <div class="col-lg-4">
            <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius">
                <h2 class="dash__h2 u-s-p-xy-20">CẢNH BÁO KHO (≤ 10)</h2>
                {{-- ID: low-stock-list --}}
                <div class="dash__pad-2" id="low-stock-list">
                    {{-- Danh sách sản phẩm sẽ render ở đây --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        let revenueChart;
        let allOrders = []; // Lưu trữ dữ liệu gốc từ API
        let allProducts = [];  // THÊM: Lưu trữ sản phẩm để check kho

        const ADMIN_API = 'http://127.0.0.1:8007/api/admin';

        document.addEventListener('DOMContentLoaded', async function () {
            // 1. Tải dữ liệu Đơn hàng (để tính doanh thu)
            await fetchOrdersData();

            // 2. THÊM: Tải dữ liệu Sản phẩm (để cảnh báo kho)
            await fetchProductsData();

            // 3. Khởi tạo biểu đồ
            initRevenueChart(30);

            // 4. Lắng nghe sự kiện filter
            document.getElementById('chart-filter').addEventListener('change', function (e) {
                const days = parseInt(e.target.value);
                updateChartData(days);
                document.getElementById('revenue-period-label').innerText = `Tổng doanh thu (${days} ngày)`;
            });
        });

        // --- HÀM TẢI DỮ LIỆU SẢN PHẨM ---
        async function fetchProductsData() {
            try {
                const res = await fetch(`${ADMIN_API}/products`);
                allProducts = await res.json();

                // Sau khi tải xong, thực hiện cập nhật UI cảnh báo kho
                updateStockWarning();
            } catch (err) {
                console.error("Lỗi tải dữ liệu sản phẩm:", err);
            }
        }

        function updateStockWarning() {
            const lowStockContainer = document.getElementById('low-stock-list');
            const countBadge = document.getElementById('stat-low-stock-count');

            // 1. Lọc sản phẩm có số lượng <= 10 dựa trên dữ liệu thật bạn vừa gửi
            const lowStockProducts = allProducts.filter(p => parseInt(p.quantity) <= 10);

            // 2. Cập nhật con số trên Widget
            countBadge.innerText = lowStockProducts.length;

            // 3. Render danh sách chi tiết ở cột phải
            if (lowStockProducts.length === 0) {
                lowStockContainer.innerHTML = '<div class="u-s-m-b-10">Tất cả sản phẩm đều đủ hàng.</div>';
                return;
            }

            lowStockContainer.innerHTML = lowStockProducts.map(p => `
                        <div class="u-s-m-b-10 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #f1f1f1; padding-bottom: 5px;">
                            <span style="font-size: 13px; color: #333; flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="${p.name}">
                                ${p.name}
                            </span>
                            <strong class="u-c-brand" style="margin-left: 10px; min-width: 60px; text-align: right;">Còn ${p.quantity}</strong>
                        </div>
                    `).join('');
        }
        async function fetchOrdersData() {
            try {
                const res = await fetch(`${ADMIN_API}/orders`);
                allOrders = await res.json();

                // SAU KHI TẢI DỮ LIỆU THẬT, CẬP NHẬT LUÔN SỐ ĐƠN CHỜ XỬ LÝ
                updatePendingOrderCount();

                console.log("Dữ liệu đơn hàng đã tải:", allOrders.length);
            } catch (err) {
                console.error("Lỗi tải dữ liệu đơn hàng:", err);
            }
        }


        function updatePendingOrderCount() {
            const pendingStatuses = ['pending_payment', 'paid'];
            const count = allOrders.filter(order => pendingStatuses.includes(order.status)).length;
            document.getElementById('stat-pending-count').innerText = count;
        }

        function fmtVND(v) {
            return new Intl.NumberFormat('vi-VN').format(v) + ' đ';
        }

        function processRevenueData(days) {
            const labels = [];
            const data = [];
            const now = new Date();
            now.setHours(23, 59, 59, 999);

            let totalRevenue = 0;
            const dailyMap = {};
            const dateKeys = [];

            // Khởi tạo khung thời gian cho biểu đồ
            for (let i = days - 1; i >= 0; i--) {
                const d = new Date();
                d.setDate(now.getDate() - i);
                const year = d.getFullYear();
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                const key = `${year}-${month}-${day}`;

                dailyMap[key] = 0;
                dateKeys.push(key);
                labels.push(`${d.getDate()}/${d.getMonth() + 1}`);
            }

            // Tính toán doanh thu từ dữ liệu thật
            allOrders.forEach(order => {
                if (order.status === 'paid' || order.status === 'completed') {
                    const rawDate = order.payment_method === 'momo' ? order.created_at : order.updated_at;
                    const d = new Date(rawDate);
                    const year = d.getFullYear();
                    const month = String(d.getMonth() + 1).padStart(2, '0');
                    const day = String(d.getDate()).padStart(2, '0');
                    const orderDateKey = `${year}-${month}-${day}`;

                    if (dailyMap.hasOwnProperty(orderDateKey)) {
                        const price = parseFloat(order.total_price);
                        dailyMap[orderDateKey] += price;
                        totalRevenue += price;
                    }
                }
            });

            dateKeys.forEach(key => {
                data.push(dailyMap[key]);
            });

            // Cập nhật Widget Tổng doanh thu
            document.getElementById('dynamic-revenue').innerText = fmtVND(totalRevenue);

            return { labels, data };
        }

        function initRevenueChart(days) {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const chartData = processRevenueData(days);

            revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Doanh thu thực tế',
                        data: chartData.data,
                        backgroundColor: '#ff4500',
                        borderRadius: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false }, ticks: { autoSkip: true, maxTicksLimit: 15 } },
                        y: {
                            beginAtZero: true,
                            ticks: { callback: value => fmtVND(value) }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (context) => `Doanh thu: ${fmtVND(context.raw)}`
                            }
                        }
                    }
                }
            });
        }

        function updateChartData(days) {
            const newData = processRevenueData(days);
            revenueChart.data.labels = newData.labels;
            revenueChart.data.datasets[0].data = newData.data;
            revenueChart.update();
        }
    </script>

    <style>
        /* Căn chỉnh lại icon trong widget */
        .dash__w-icon {
            display: flex;
            /* Sử dụng flexbox */
            align-items: center;
            /* Căn giữa theo chiều dọc */
            justify-content: center;
            /* Căn giữa theo chiều ngang */
            width: 50px;
            /* Độ rộng của vòng bao quanh */
            height: 50px;
            /* Chiều cao của vòng bao quanh */
            border-radius: 50%;
            /* Biến thành hình tròn */
            font-size: 20px;
            /* Kích thước của icon bên trong */
            margin-bottom: 10px;
            /* Khoảng cách dưới icon */
        }

        /* Đảm bảo icon bên trong (FontAwesome) không có margin thừa */
        .dash__w-icon i {
            line-height: 1;
            margin: 0;
            padding: 0;
        }

        .dash__w-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        /* Tùy chỉnh màu sắc viền/nền nếu cần (giữ nguyên style hiện tại của bạn) */
        .dash__w-icon-style-1 {
            border: 2px solid #ff4500;
            color: #ff4500;
        }

        .dash__w-icon-style-2 {
            border: 2px solid #28a745;
            color: #28a745;
        }

        .dash__w-icon-style-3 {
            border: 2px solid #ffc107;
            color: #ffc107;
        }

        .manage-o__badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge--delivered {
            background-color: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }
    </style>

@endsection
