@extends('admin.layouts.admin_app')
@section('admin_content')
    <div class="col-lg-9 col-md-12">
        <h1 class="dash__h1 u-s-m-b-30">Quản lý Đơn hàng: <span id="order-id-title"></span></h1>

        {{-- HÀNH ĐỘNG CỦA ADMIN --}}
        <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
            <div class="dash__pad-2">
                <h2 class="dash__h2 u-s-m-b-15">HÀNH ĐỘNG QUẢN TRỊ</h2>
                <div id="admin-actions" class="d-flex gap-10">
                    {{-- Nút sẽ hiện dựa trên trạng thái hiện tại --}}
                </div>
            </div>
        </div>

        <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
            <div class="dash__pad-2">
                <div class="dash-l-r">
                    <div>
                        <div class="manage-o__text-2 u-c-secondary">Mã đơn: <span id="order-code">Đang tải...</span></div>
                        <div class="manage-o__text u-c-silver">Ngày đặt: <span id="order-date">...</span></div>
                    </div>
                    <div>
                        <div class="manage-o__text-2 u-c-silver">Tổng cộng:
                            <span class="manage-o__text-2 u-c-secondary" id="order-total">0 đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
            <div class="dash__pad-2">
                <div class="manage-o">
                    <div class="dash-l-r u-s-m-b-30">
                        <div class="manage-o__text u-c-secondary">Trạng thái: <strong id="order-status-text">...</strong>
                        </div>
                        <div class="manage-o__icon"><i class="fas fa-truck u-s-m-r-5"></i><span class="manage-o__text">Giao
                                hàng tiêu chuẩn</span></div>
                    </div>

                    <div class="manage-o__timeline">
                        <div class="timeline-track">
                            <div class="timeline-step" id="step-1">
                                <div class="timeline-l-i"><span class="timeline-square"></span></div><span
                                    class="timeline-text">ĐANG XỬ LÝ</span>
                            </div>
                            <div class="timeline-step" id="step-2">
                                <div class="timeline-l-i"><span class="timeline-square"></span></div><span
                                    class="timeline-text">ĐANG GIAO</span>
                            </div>
                            <div class="timeline-step" id="step-3">
                                <div class="timeline-l-i"><span class="timeline-square"></span></div><span
                                    class="timeline-text">ĐÃ GIAO</span>
                            </div>
                        </div>
                    </div>

                    <div id="order-items-list" class="u-s-m-t-30">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="dash__box dash__box--bg-white dash__box--shadow u-h-100">
                    <div class="dash__pad-3">
                        <h2 class="dash__h2 u-s-m-b-16">Thông tin nhận hàng</h2>
                        <div class="info-row">
                            <div class="info-label">Người nhận:</div>
                            <div class="info-value" id="receiver-name">...</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Số điện thoại:</div>
                            <div class="info-value" id="receiver-phone">...</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Địa chỉ:</div>
                            <div class="info-value" id="receiver-address">...</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Email:</div>
                            <div class="info-value" id="receiver-email">...</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dash__box dash__box--bg-white dash__box--shadow u-h-100">
                    <div class="dash__pad-3">
                        <h2 class="dash__h2 u-s-m-b-16">Tổng kết đơn hàng</h2>
                        <div class="summary-row">
                            <div class="summary-label">Tạm tính:</div>
                            <div class="summary-value" id="sum-subtotal">0 đ</div>
                        </div>
                        <div class="summary-row">
                            <div class="summary-label">Phí vận chuyển:</div>
                            <div class="summary-value" id="sum-shipping">0 đ</div>
                        </div>
                        <div class="summary-row" style="border-top: 1px solid #eee; padding-top: 10px; margin-top: 10px;">
                            <div class="summary-label"><strong>Tổng cộng:</strong></div>
                            <div class="summary-value" id="sum-total"><strong class="u-c-secondary">0 đ</strong></div>
                        </div>
                        <div class="u-s-m-t-15"><span class="gl-label" id="payment-method-text">...</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const publicId = "{{ $public_id }}";
        const ADMIN_API = 'http://127.0.0.1:8007/api/admin';
        const PRODUCT_SERVICE = 'http://127.0.0.1:8003';
        const PRODUCT_IMG_BASE = 'http://127.0.0.1:8000';

        // 1. Cập nhật Timeline Progress
        function setTimelineStatus(status) {
            if (status === "cancelled") {
                for (let i = 1; i <= 3; i++) {
                    document.getElementById(`step-${i}`).classList.remove("completed", "active");
                }
                return;
            }

            const statusStepMap = {
                pending_payment: 1,
                paid: 1,
                processing: 1,
                delivering: 2,
                completed: 3
            };

            const step = statusStepMap[status] ?? 1;

            for (let i = 1; i <= 3; i++) {
                const node = document.getElementById(`step-${i}`);
                node.classList.remove("completed", "active");
                if (i < step) node.classList.add("completed");
                else if (i === step) node.classList.add("active");
            }
        }

        // 2. Định dạng tiền tệ
        function fmtMoney(v) {
            return new Intl.NumberFormat("vi-VN").format(v) + " đ";
        }

        // 3. Tải chi tiết đơn hàng
        async function loadOrderDetail() {
            try {
                const res = await fetch(`${ADMIN_API}/orders/${publicId}`);
                const data = await res.json();
                const { order, items } = data;

                // Header & Thông tin chung
                document.getElementById('order-code').innerText = "#" + order.public_id;
                document.getElementById('order-date').innerText = new Date(order.created_at).toLocaleString("vi-VN");
                document.getElementById('order-total').innerText = fmtMoney(order.total_price);
                document.getElementById('order-id-title').innerText = order.public_id;

                // Trạng thái & Timeline
                const statusMap = {
                    pending_payment: "Chờ thanh toán",
                    paid: "Đang xử lý (Đã thanh toán)",
                    delivering: "Đang giao hàng",
                    completed: "Hoàn thành",
                    cancelled: "Đã hủy"
                };
                document.getElementById('order-status-text').innerText = statusMap[order.status] || order.status;
                setTimelineStatus(order.status);
                renderAdminActions(order.status);

                // Thông tin khách hàng
                document.getElementById('receiver-name').innerText = order.receiver_name;
                document.getElementById('receiver-phone').innerText = order.receiver_phone;
                document.getElementById('receiver-email').innerText = order.receiver_email || 'N/A';
                document.getElementById('receiver-address').innerText = `${order.street_address}, ${order.district_name}`;

                // Tóm tắt tiền
                let subtotal = items.reduce((sum, item) => sum + Number(item.subtotal), 0);
                document.getElementById('sum-subtotal').innerText = fmtMoney(subtotal);
                document.getElementById('sum-shipping').innerText = fmtMoney(order.shipping_fee || 0);
                document.getElementById('sum-total').innerText = fmtMoney(order.total_price);
                document.getElementById('payment-method-text').innerText = order.payment_method === 'cod' ? 'Thanh toán COD' : 'Thanh toán MoMo';

                // Danh sách sản phẩm (kèm ảnh)
                await renderOrderItems(items);

            } catch (err) {
                console.error("Lỗi tải chi tiết đơn hàng:", err);
            }
        }

        // 4. Render sản phẩm (gọi Product Service lấy ảnh)
        async function renderOrderItems(items) {
            const container = document.getElementById('order-items-list');
            container.innerHTML = "";

            for (const item of items) {
                // 1. Gọi Product Service lấy thông tin ảnh primary
                const imgRes = await fetch(`${PRODUCT_SERVICE}/products/${item.product_id}/primary-image`);
                const imgData = await imgRes.json();

                let imgSrc = "/images/default.jpg"; // Ảnh mặc định nếu lỗi

                if (imgData && imgData.image_url) {
                    // 2. Chuẩn hóa đường dẫn: thay \ thành / và xóa / ở đầu nếu có
                    let path = imgData.image_url.replace(/\\/g, '/');
                    if (path.startsWith('/')) path = path.substring(1);

                    // 3. Nối với Host của Frontend (Cổng 8000)
                    imgSrc = `${PRODUCT_IMG_BASE}/${path}`;
                }

                container.innerHTML += `
                <div class="manage-o__description u-s-m-b-20" style="padding-bottom: 15px; border-bottom: 1px dashed #eee;">
                    <div class="description__container">
                        <div class="description__img-wrap">
                            <img class="u-img-fluid" src="${imgSrc}" onerror="this.src='/images/default.jpg'" alt="">
                        </div>
                        <div class="description-title" style="font-weight: 600;">${item.product_name}</div>
                    </div>
                    <div class="description__info-wrap">
                        <div><span class="manage-o__text-2 u-c-silver">Số lượng: <span class="u-c-secondary">${item.quantity}</span></span></div>
                        <div><span class="manage-o__text-2 u-c-silver">Đơn giá: <span class="u-c-secondary">${fmtMoney(item.price)}</span></span></div>
                        <div><span class="manage-o__text-2 u-c-silver">Tổng: <span class="u-c-secondary">${fmtMoney(item.subtotal)}</span></span></div>
                    </div>
                </div>
            `;
            }
        }

        // 5. Cập nhật trạng thái (Admin Action)
        async function updateOrderStatus(newStatus) {
            if (!confirm(`Xác nhận chuyển trạng thái sang: ${newStatus}?`)) return;

            const res = await fetch(`${ADMIN_API}/orders/${publicId}/status`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ status: newStatus })
            });

            if (res.ok) {
                alert("Cập nhật trạng thái thành công!");
                location.reload();
            }
        }

        // 6. Hiển thị nút bấm quản trị
        function renderAdminActions(status) {
            const container = document.getElementById('admin-actions');
            let html = '';

            if (status === 'pending_payment' || status === 'paid') {
                html += `<button onclick="updateOrderStatus('delivering')" class="btn btn--e-brand-b-2">DUYỆT & GIAO HÀNG</button>`;
                html += `<button onclick="updateOrderStatus('cancelled')" class="btn btn--e-dark-outline u-s-m-l-10">HỦY ĐƠN</button>`;
            } else if (status === 'delivering') {
                html += `<button onclick="updateOrderStatus('completed')" class="btn btn--e-brand-b-2">XÁC NHẬN ĐÃ GIAO</button>`;
                html += `<button onclick="updateOrderStatus('cancelled')" class="btn btn--e-dark-outline u-s-m-l-10">GIAO THẤT BẠI (HỦY)</button>`;
            }

            container.innerHTML = html || '<span class="u-c-silver">Đơn hàng đã kết thúc, không thể thao tác thêm.</span>';
        }

        document.addEventListener("DOMContentLoaded", loadOrderDetail);
    </script>
@endsection
