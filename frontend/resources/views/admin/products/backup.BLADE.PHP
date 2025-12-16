{{-- resources/views/admin/products/index.blade.php (Phiên bản cuối cùng) --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Quản Lý Sản Phẩm')

@section('admin_content')

    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Danh Sách Sản Phẩm</h1>

            <div class="u-s-m-b-30 d-flex justify-content-between align-items-center">
                {{-- Nút này giờ chỉ dùng JS để mở form THÊM MỚI --}}
                <a href="#" id="create-product-btn" class="btn btn--e-brand-b-2">
                    <i class="fas fa-plus u-s-m-r-6"></i> Thêm Sản Phẩm
                </a>
                <form class="main-form" method="GET" style="width: 50%;">
                    <label for="admin-product-search"></label>
                    <input class="input-text input-text--border-radius input-text--style-1" type="text"
                        id="admin-product-search" name="search" value="{{ request('search') }}"
                        placeholder="Tìm kiếm theo tên...">
                    <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
                </form>
            </div>

            {{-- 1. KHU VỰC MODAL (ẨN BAN ĐẦU) --}}
            <div id="product-form-container" style="display: none;">

                {{-- CSS Modal và Grid Form --}}
                <style>
                    .modal-overlay {
                        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                        background-color: rgba(0, 0, 0, 0.7);
                        z-index: 1000; overflow: auto; padding: 20px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
                    .modal-content {
                        background-color: #fefefe;
                        padding: 20px; border: 1px solid #888;
                        width: 95%; max-width: 800px;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
                    }
                    .form-grid-layout {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 20px;
                    }
                    .form-grid-full-span {
                        grid-column: 1 / -1;
                    }
                </style>

                <div class="modal-overlay">
                    <div class="modal-content">

                        <div class="dash__pad-2">
                            {{-- Tiêu đề form được điều khiển bằng JS --}}
                            <h1 class="dash__h1 u-s-m-b-14 u-c-secondary" id="form-title">THÊM SẢN PHẨM MỚI</h1>
                            <span class="dash__text u-s-m-b-30">Vui lòng nhập đầy đủ thông tin chi tiết sản phẩm.</span>

                            {{-- Form đã được tối ưu cho 2 chế độ Thêm/Sửa --}}
                            <form class="l-f-o__form" method="POST" id="product-form" action="{{ route('admin.products.store') }}">
                                @csrf
                                {{-- Input ẩn để JS điều khiển Method PUT/POST --}}
                                <input type="hidden" name="_method" id="form-method" value="POST">

                                <div class="form-grid-layout">
                                    {{-- Cột 1: Tên Sản Phẩm --}}
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="product-name">TÊN SẢN PHẨM *</label>
                                        <input class="input-text input-text--primary-style" type="text" id="product-name" name="name" placeholder="Ví dụ: Ghế Sofa Bọc Da" required>
                                    </div>

                                    {{-- Cột 2: Giá --}}
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="product-price">GIÁ (VND/USD) *</label>
                                        <input class="input-text input-text--primary-style" type="number" id="product-price" name="price" placeholder="Ví dụ: 5000000" required>
                                    </div>

                                    {{-- Cột 3: URL Ảnh --}}
                                    <div class="u-s-m-b-30 form-grid-full-span">
                                        <label class="gl-label" for="product-image">URL ẢNH CHÍNH (hoặc upload file)</label>
                                        <input class="input-text input-text--primary-style" type="text" id="product-image" name="image_url" placeholder="http://...">
                                    </div>

                                    {{-- Cột 4: Trạng Thái --}}
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="product-status">TRẠNG THÁI *</label>
                                        <select class="select-box select-box--primary-style" id="product-status" name="status">
                                            <option value="active">Hoạt động</option>
                                            <option value="draft">Nháp</option>
                                        </select>
                                    </div>

                                    {{-- Vùng Mô Tả Chi Tiết --}}
                                    <div class="u-s-m-b-30 form-grid-full-span">
                                        <label class="gl-label" for="product-description">MÔ TẢ CHI TIẾT *</label>
                                        <textarea class="text-area text-area--primary-style" id="product-description" name="description" required></textarea>
                                    </div>
                                </div>

                                {{-- Nút Submit (Text được điều khiển bằng JS) --}}
                                <div class="u-s-m-b-30">
                                    <button class="btn btn--e-brand-b-2" type="submit" id="form-submit-btn">THÊM SẢN PHẨM</button>
                                </div>
                            </form>
                        </div>

                        {{-- Nút Hủy/Quay lại trong modal --}}
                        <div class="u-s-m-b-30">
                            <button class="btn btn--e-dark" type="button" id="cancel-form-btn">
                                <i class="fas fa-arrow-left u-s-m-r-6"></i> Quay lại Danh sách
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. KHU VỰC HIỂN THỊ DANH SÁCH --}}
            <div id="product-list-wrapper">
                <h2 class="dash__h2 u-s-p-xy-20">25 Sản Phẩm Tìm Thấy</h2>
                <div class="dash__table-wrap gl-scroll">
                    <table class="dash__table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Kho hàng</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Vòng lặp cho dữ liệu sản phẩm thực tế --}}
                            <tr>
                                <td>1</td>
                                <td><div class="dash__table-img-wrap"><img class="u-img-fluid" src="{{ asset('images/product/electronic/product3.jpg') }}" alt=""></div></td>
                                <td>Yellow Wireless Headphone</td>
                                <td>$125.00</td>
                                <td>50</td>
                                <td><span class="gl-label u-c-brand">Active</span></td>
                                <td>
                                    <div class="dash__link dash__link--brand">
                                        {{-- THAY ĐỔI LỚN: Thêm class và data attributes cho JS bắt sự kiện --}}
                                        <a href="#"
                                           class="edit-product-btn"
                                           data-product-id="1"
                                           data-fetch-url="{{ route('admin.products.getData', 1) }}">SỬA</a> |
                                        <a href="#" onclick="confirm('Xác nhận xóa sản phẩm này?')">XÓA</a>
                                    </div>
                                </td>
                            </tr>
                            {{-- Thêm các dòng sản phẩm khác tại đây, nhớ cập nhật data-product-id và data-fetch-url --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy các phần tử
            const createBtn = document.getElementById('create-product-btn');
            const formContainer = document.getElementById('product-form-container');
            const productListWrapper = document.getElementById('product-list-wrapper');
            const cancelBtn = document.getElementById('cancel-form-btn');
            const form = document.getElementById('product-form');

            // --- HÀM CHUNG ---
            const showForm = () => {
                productListWrapper.style.display = 'none'; // Ẩn danh sách
                formContainer.style.display = 'block';     // Hiện Modal
                document.body.style.overflow = 'hidden';   // Ngăn cuộn trang chính
            };

            const hideForm = () => {
                formContainer.style.display = 'none';     // Ẩn Modal
                productListWrapper.style.display = 'block'; // Hiện lại danh sách
                document.body.style.overflow = 'auto';    // Cho phép cuộn trang chính
            };

            const resetForm = () => {
                // Đặt lại trạng thái về THÊM MỚI
                document.getElementById('form-title').innerText = 'THÊM SẢN PHẨM MỚI';
                document.getElementById('form-submit-btn').innerText = 'THÊM SẢN PHẨM';
                form.action = '{{ route('admin.products.store') }}';
                document.getElementById('form-method').value = 'POST';
                form.reset();

                // Đảm bảo select status trở về default (active)
                document.getElementById('product-status').value = 'active';
            };


            // --- XỬ LÝ SỰ KIỆN ---

            // 1. Gắn sự kiện cho nút "Thêm Sản Phẩm"
            if (createBtn) {
                createBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    resetForm(); // Đặt lại form trước khi hiện
                    showForm();
                });
            }

            // 2. Gắn sự kiện cho nút "Hủy/Quay lại Danh sách"
            if (cancelBtn) {
                cancelBtn.addEventListener('click', hideForm);
            }

            // 3. Gắn sự kiện cho nút "SỬA" (Edit Mode)
            document.querySelectorAll('.edit-product-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const productId = this.getAttribute('data-product-id');
                    const fetchUrl = this.getAttribute('data-fetch-url');

                    // 1. Reset form về trạng thái cơ bản (tránh lỗi)
                    resetForm();

                    // 2. Lấy dữ liệu sản phẩm bằng AJAX/Fetch
                    fetch(fetchUrl)
                        .then(response => {
                            if (!response.ok) {
                                // Nếu controller trả về lỗi 404 hoặc 500
                                throw new Error('Không thể tải dữ liệu sản phẩm: ' + response.statusText);
                            }
                            return response.json();
                        })
                        .then(product => {
                            // 3. Cập nhật Form cho chế độ SỬA

                            // Cập nhật tiêu đề và nút submit
                            document.getElementById('form-title').innerText = 'CHỈNH SỬA SẢN PHẨM: ' + (product.name || 'ID ' + productId);
                            document.getElementById('form-submit-btn').innerText = 'CẬP NHẬT SẢN PHẨM';

                            // Cập nhật Action và Method
                            // Chú ý: Thay thế ':product' bằng productId thực tế
                            const updateUrl = '{{ route('admin.products.update', ['product' => ':product']) }}'.replace(':product', productId);
                            form.action = updateUrl;
                            document.getElementById('form-method').value = 'PUT';

                            // 4. Điền dữ liệu vào các trường (Giả định key trong JSON trùng với ID/name)
                            document.getElementById('product-name').value = product.name || '';
                            document.getElementById('product-price').value = product.price || '';
                            document.getElementById('product-description').value = product.description || '';
                            document.getElementById('product-image').value = product.image_url || '';

                            // Cập nhật Trạng thái (Select)
                            document.getElementById('product-status').value = product.status || 'draft';

                            showForm(); // Hiện Modal
                        })
                        .catch(error => {
                            console.error('Lỗi khi lấy dữ liệu:', error);
                            alert('Lỗi: Không thể tải dữ liệu sản phẩm để chỉnh sửa. Vui lòng kiểm tra console.');
                        });
                });
            });
        });
    </script>
@endsection
