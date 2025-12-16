{{-- resources/views/admin/products/index.blade.php (Phiên bản Cuối cùng) --}}
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

            {{-- 1. KHU VỰT MODAL (ẨN BAN ĐẦU) --}}
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
                        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                    }
                    .form-grid-layout {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 20px;
                    }
                    /* THAY ĐỔI QUAN TRỌNG: Kéo giãn và Đồng bộ chiều cao */
                    .form-grid-layout .input-text,
                    .form-grid-layout .select-box,
                    .form-grid-layout .text-area {
                        width: 100%;
                        box-sizing: border-box;
                        height: 40px; /* Chiều cao cố định */
                        padding: 8px 15px;
                    }
                    .form-grid-layout .text-area {
                        height: 120px; /* Giữ textarea cao hơn */
                    }
                    .form-grid-layout .select-box {
                        appearance: none;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="gray" d="M8 11L3 6h10z"/></svg>');
                        background-repeat: no-repeat;
                        background-position: right 15px center;
                        background-size: 10px;
                    }
                    .form-grid-full-span {
                        grid-column: 1 / -1;
                    }

                    /* CUSTOM FILE UPLOAD STYLES */
                    .custom-file-upload-wrapper {
                        display: flex;
                        align-items: center;
                        border: 1px solid #adb5bd;
                        border-radius: 3px;
                        height: 40px;
                        padding: 0;
                        overflow: hidden;
                        cursor: pointer;
                        background-color: #fff;
                    }
                    .custom-file-text {
                        flex-grow: 1;
                        padding: 0 10px;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        color: #6c757d;
                        font-size: 14px;
                    }
                    .custom-file-button {
                        background-color: #adb5bd;
                        color: white;
                        padding: 0 15px;
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: 700;
                        cursor: pointer;
                        transition: background-color 0.2s;
                    }
                    .custom-file-button:hover {
                        background-color: #6c757d;
                    }
                    /* FOOTER STYLES */
                    .modal-footer-flex {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding-top: 20px;
                        border-top: 1px solid #eee;
                    }
                    .btn--e-dark-outline {
                        background-color: #f8f9fa;
                        color: #6c757d;
                        border: 1px solid #adb5bd;
                        min-width: 160px;
                        text-align: center;
                        line-height: 1;
                        padding: 12px 20px;
                        border-radius: 3px;
                        font-size: 14px;
                        font-weight: 700;
                        transition: background-color 0.2s;
                    }
                    .btn--e-dark-outline:hover {
                        background-color: #e2e6ea;
                    }
                </style>

                <div class="modal-overlay">
                    <div class="modal-content">

                        <div class="dash__pad-2">
                            {{-- Tiêu đề form được điều khiển bằng JS --}}
                            <h1 class="dash__h1 u-s-m-b-14 u-c-secondary" id="form-title">THÊM SẢN PHẨM MỚI</h1>
                            <span class="dash__text u-s-m-b-30">Vui lòng nhập đầy đủ thông tin chi tiết sản phẩm.</span>

                            {{-- Form đã được tối ưu cho 2 chế độ Thêm/Sửa --}}
                            <form class="l-f-o__form" method="POST" id="product-form"
                                action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                                @csrf
                                {{-- Input ẩn để JS điều khiển Method PUT/POST --}}
                                <input type="hidden" name="_method" id="form-method" value="POST">

                                <div class="form-grid-layout">

                                    {{-- HÀNG 1: TÊN SẢN PHẨM & GIÁ --}}
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="product-name">TÊN SẢN PHẨM *</label>
                                        <input class="input-text input-text--primary-style" type="text" id="product-name"
                                            name="name" placeholder="Ví dụ: Ghế Sofa Bọc Da" required>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="product-price">GIÁ (VND/USD) *</label>
                                        <input class="input-text input-text--primary-style" type="number" id="product-price"
                                            name="price" placeholder="Ví dụ: 5000000" required>
                                    </div>

                                    {{-- HÀNG 2: DANH MỤC & SỐ LƯỢNG --}}
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="product-category">DANH MỤC *</label>
                                        <select class="select-box select-box--primary-style" id="product-category"
                                            name="category_id" required>
                                            <option value="" disabled selected>Chọn danh mục</option>
                                            @php
                                                $categories = [
                                                    ['id' => 1, 'name' => 'Điện tử'],
                                                    ['id' => 2, 'name' => 'Nội thất'],
                                                    ['id' => 3, 'name' => 'Thời trang'],
                                                ];
                                            @endphp
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="product-stock">SỐ LƯỢNG TỒN KHO *</label>
                                        <input class="input-text input-text--primary-style" type="number" id="product-stock"
                                            name="stock" placeholder="Ví dụ: 50" min="0" required>
                                    </div>

                                    {{-- HÀNG 3: UPLOAD ẢNH VÀ MODEL 3D (FULL SPAN) --}}
                                    <div class="u-s-m-b-30 form-grid-full-span">
                                        <div class="form-grid-layout" style="gap: 20px;">

                                            {{-- Vùng 1: TẢI LÊN ẢNH CHÍNH --}}
                                            <div class="u-s-m-b-0">
                                                <label class="gl-label" for="product-image-file">TẢI LÊN ẢNH CHÍNH (Chọn File)</label>
                                                {{-- Ẩn input file mặc định --}}
                                                <input class="input-text input-text--primary-style" type="file"
                                                    id="product-image-file" name="image_file" accept="image/jpeg,image/png" style="display: none;">
                                                <input type="hidden" name="current_image_url" id="current_image_url">

                                                {{-- Giao diện custom upload --}}
                                                <label for="product-image-file" class="custom-file-upload-wrapper">
                                                    <span class="custom-file-text" id="image-file-name">Chưa có tệp nào được chọn</span>
                                                    <span class="custom-file-button">Chọn tệp</span>
                                                </label>
                                            </div>

                                            {{-- Vùng 2: TẢI LÊN MODEL 3D --}}
                                            <div class="u-s-m-b-0">
                                                <label class="gl-label" for="product-model-file">TẢI LÊN MODEL 3D (Chọn File .glb/.gltf)</label>
                                                {{-- Ẩn input file mặc định --}}
                                                <input class="input-text input-text--primary-style" type="file"
                                                    id="product-model-file" name="model_file" accept=".glb,.gltf" style="display: none;">
                                                <input type="hidden" name="current_model_url" id="current_model_url">

                                                {{-- Giao diện custom upload --}}
                                                <label for="product-model-file" class="custom-file-upload-wrapper">
                                                    <span class="custom-file-text" id="model-file-name">Chưa có tệp nào được chọn</span>
                                                    <span class="custom-file-button">Chọn tệp</span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Vùng Mô Tả Chi Tiết (Giữ nguyên, chiếm full span) --}}
                                    <div class="u-s-m-b-30 form-grid-full-span">
                                        <label class="gl-label" for="product-description">MÔ TẢ CHI TIẾT *</label>
                                        <textarea class="text-area text-area--primary-style" id="product-description"
                                            name="description" required></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- KHỐI FOOTER MỚI: Đặt đối xứng các nút --}}
                        <div class="modal-footer-flex">

                            {{-- NÚT 1: QUAY LẠI (Góc Trái) --}}
                            <button class="btn btn--e-dark-outline" type="button" id="cancel-form-btn-modal">
                                Quay lại
                            </button>

                            {{-- NÚT 2: SUBMIT/CẬP NHẬT (Góc Phải) --}}
                            <button class="btn btn--e-brand-b-2" type="button" id="submit-form-btn-modal">
                                <span id="form-submit-text">THÊM SẢN PHẨM</span>
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
                            {{-- Dữ liệu mẫu --}}
                            <tr>
                                <td>1</td>
                                <td><div class="dash__table-img-wrap"><img class="u-img-fluid" src="{{ asset('images/product/electronic/product3.jpg') }}" alt=""></div></td>
                                <td>Yellow Wireless Headphone</td>
                                <td>$125.00</td>
                                <td>50</td>
                                <td><span class="gl-label u-c-brand">Active</span></td>
                                <td>
                                    <div class="dash__link dash__link--brand">
                                        <a href="#" class="edit-product-btn" data-product-id="1" data-fetch-url="{{ route('admin.products.getData', 1) }}">SỬA</a> |
                                        <a href="#" onclick="confirm('Xác nhận xóa sản phẩm này?')">XÓA</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><div class="dash__table-img-wrap"><img class="u-img-fluid" src="{{ asset('images/product/electronic/product2.jpg') }}" alt=""></div></td>
                                <td>Premium Monitor</td>
                                <td>$499.00</td>
                                <td>15</td>
                                <td><span class="gl-label u-c-secondary">Draft</span></td>
                                <td>
                                    <div class="dash__link dash__link--brand">
                                        <a href="#" class="edit-product-btn" data-product-id="2" data-fetch-url="{{ route('admin.products.getData', 2) }}">SỬA</a> |
                                        <a href="#" onclick="confirm('Xác nhận xóa sản phẩm này?')">XÓA</a>
                                    </div>
                                </td>
                            </tr>
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
            const cancelBtnModal = document.getElementById('cancel-form-btn-modal');
            const submitBtnModal = document.getElementById('submit-form-btn-modal');
            const form = document.getElementById('product-form');
            const formSubmitText = document.getElementById('form-submit-text');

            // --- HÀM CHUNG ---
            const showForm = () => {
                productListWrapper.style.display = 'none';
                formContainer.style.display = 'block';
                document.body.style.overflow = 'hidden'; // Ngăn cuộn trang chính
            };

            const hideForm = () => {
                formContainer.style.display = 'none';
                productListWrapper.style.display = 'block';
                document.body.style.overflow = 'auto'; // Cho phép cuộn trang chính
            };

            const resetForm = () => {
                // Đặt lại trạng thái về THÊM MỚI
                document.getElementById('form-title').innerText = 'THÊM SẢN PHẨM MỚI';
                formSubmitText.innerText = 'THÊM SẢN PHẨM';
                form.action = '{{ route('admin.products.store') }}';
                document.getElementById('form-method').value = 'POST';
                form.reset();

                // Reset các trường mới
                document.getElementById('product-category').value = '';
                document.getElementById('product-stock').value = '';
                document.getElementById('product-image-file').value = '';
                document.getElementById('product-model-file').value = '';
                document.getElementById('current_image_url').value = '';
                document.getElementById('current_model_url').value = '';

                // Reset text hiển thị file
                document.getElementById('image-file-name').textContent = 'Chưa có tệp nào được chọn';
                document.getElementById('model-file-name').textContent = 'Chưa có tệp nào được chọn';
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

            // 2. Gắn sự kiện cho nút "Hủy/Quay lại Danh sách" trong Modal
            if (cancelBtnModal) {
                cancelBtnModal.addEventListener('click', hideForm);
            }

            // 3. Gắn sự kiện cho nút SUBMIT (Kích hoạt Form Submit)
            if (submitBtnModal) {
                submitBtnModal.addEventListener('click', function () {
                    form.submit(); // Kích hoạt hành động submit form
                });
            }

            // 4. Gắn sự kiện cho nút "SỬA" (Edit Mode) - TẠM THỜI
            document.querySelectorAll('.edit-product-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    const productId = this.getAttribute('data-product-id');

                    // 1. Reset form về trạng thái cơ bản
                    resetForm();

                    // *************************************************************
                    // *** KHỐI TẠM THỜI: THAY THẾ FETCH BẰNG DỮ LIỆU MÔ PHỎNG ***
                    // *************************************************************

                    // Dữ liệu giả lập cho chế độ SỬA
                    const mockProduct = {
                        name: 'Sản phẩm SỬA tạm thời (ID ' + productId + ')',
                        price: 999000,
                        description: 'Mô tả tạm thời cho sản phẩm ID ' + productId + '.',
                        category_id: 2, // Nội thất
                        stock: 75,
                        current_image_url: 'http://link-den-anh-cu/sp' + productId + '.jpg',
                        current_model_url: 'http://link-den-model-cu/model' + productId + '.glb'
                    };

                    // Cập nhật Form cho chế độ SỬA
                    document.getElementById('form-title').innerText = 'CHỈNH SỬA SẢN PHẨM (TẠM): ID ' + productId;
                    formSubmitText.innerText = 'CẬP NHẬT SẢN PHẨM';

                    // Cập nhật Action và Method
                    const updateUrl = '{{ route('admin.products.update', ['product' => ':product']) }}'.replace(':product', productId);
                    form.action = updateUrl;
                    document.getElementById('form-method').value = 'PUT';

                    // Điền dữ liệu mô phỏng vào các trường
                    document.getElementById('product-name').value = mockProduct.name;
                    document.getElementById('product-price').value = mockProduct.price;
                    document.getElementById('product-description').value = mockProduct.description;

                    document.getElementById('product-stock').value = mockProduct.stock;
                    document.getElementById('product-category').value = mockProduct.category_id;
                    document.getElementById('current_image_url').value = mockProduct.current_image_url;
                    document.getElementById('current_model_url').value = mockProduct.current_model_url;

                    // Hiển thị tên file cũ trên giao diện custom upload
                    document.getElementById('image-file-name').textContent = mockProduct.current_image_url.split('/').pop();
                    document.getElementById('model-file-name').textContent = mockProduct.current_model_url.split('/').pop();

                    showForm(); // Hiện Modal
                });
            });

            // 5. Xử lý hiển thị tên file khi upload thực tế
            const fileInputs = [
                { inputId: 'product-image-file', nameId: 'image-file-name', urlId: 'current_image_url' },
                { inputId: 'product-model-file', nameId: 'model-file-name', urlId: 'current_model_url' }
            ];

            fileInputs.forEach(item => {
                const input = document.getElementById(item.inputId);
                const nameSpan = document.getElementById(item.nameId);
                const currentUrlInput = document.getElementById(item.urlId);

                if (input && nameSpan) {
                    input.addEventListener('change', function() {
                        if (this.files.length > 0) {
                            nameSpan.textContent = this.files[0].name;
                        } else if (currentUrlInput && currentUrlInput.value) {
                            // Quay về hiển thị URL cũ nếu input file bị hủy
                            nameSpan.textContent = currentUrlInput.value.split('/').pop();
                        } else {
                            nameSpan.textContent = 'Chưa có tệp nào được chọn';
                        }
                    });
                }
            });
        });
    </script>
@endsection
