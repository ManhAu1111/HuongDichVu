@extends('admin.layouts.admin_app')
@section('admin_title', 'Quản Lý Sản Phẩm')
@section('admin_content')
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Danh Sách Sản Phẩm</h1>
            {{-- THANH BỘ LỌC (FILTER BAR) --}}
            <div class="filter-container u-s-m-b-30">
                <div class="row-filter">
                    <div class="filter-item">
                        <label class="gl-label">TÌM TÊN</label>
                        <input class="input-text input-text--primary-style" type="text" id="filter-search"
                            placeholder="Nhập tên...">
                    </div>
                    <div class="filter-item">
                        <label class="gl-label">DANH MỤC</label>
                        <select class="select-box select-box--primary-style" id="filter-category">
                            <option value="">Tất cả danh mục</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label class="gl-label">GIÁ TỪ</label>
                        <input class="input-text input-text--primary-style" type="number" id="filter-price-min"
                            placeholder="Min">
                    </div>
                    <div class="filter-item">
                        <label class="gl-label">ĐẾN</label>
                        <input class="input-text input-text--primary-style" type="number" id="filter-price-max"
                            placeholder="Max">
                    </div>
                    <div class="filter-item d-flex align-items-end">
                        <button class="btn btn--e-brand-b-2" id="btn-apply-filter">LỌC</button>
                        <button class="btn btn--e-transparent-brand-b-2 u-s-m-l-10" id="btn-reset-filter">RESET</button>
                    </div>
                </div>
            </div>
            <div class="u-s-m-b-30 d-flex justify-content-between align-items-center">
                <a href="#" id="create-product-btn" class="btn btn--e-brand-b-2">
                    <i class="fas fa-plus u-s-m-r-6"></i> Thêm Sản Phẩm
                </a>
                <h2 class="dash__h2" id="product-count-text">Đang tải...</h2>
            </div>
            {{-- BẢNG DỮ LIỆU --}}
            <div id="product-list-wrapper">
                <div class="dash__table-wrap gl-scroll">
                    <table class="dash__table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Kho hàng</th>
                                <th>Danh mục</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="product-list-body"></tbody>
                    </table>
                </div>
            </div>
            {{-- PHÂN TRANG (PAGINATION) --}}
            <div class="u-s-p-y-60 d-flex justify-content-center">
                <ul class="shop-p__pagination" id="pagination-controls">
                </ul>
            </div>
        </div>
    </div>

    <style>
        .row-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }

        .filter-item {
            flex: 1;
            min-width: 150px;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            width: 95%;
            max-width: 800px;
            border-radius: 8px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .shop-p__pagination li {
            cursor: pointer;
            user-select: none;
            margin: 0 5px;
            padding: 5px 12px;
            border: 1px solid #eee;
        }

        .shop-p__pagination li.is-active {
            background-color: #ff4500;
            color: #fff;
            border-color: #ff4500;
        }

        .shop-p__pagination li:hover:not(.is-active) {
            background-color: #f5f5f5;
        }
    </style>

    @include('admin.products.partials.modal_product')

    {{--
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js"></script> --}}
    <script>
        if (!window.customElements.get('model-viewer')) {
            const script = document.createElement('script');
            script.type = 'module';
            script.src = 'https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js';
            document.head.appendChild(script);
        }

        const ADMIN_API = 'http://127.0.0.1:8007/api/admin';
        const PRODUCT_IMG_BASE = 'http://127.0.0.1:8000';

        let categoryMap = {};
        let allProducts = [];
        let filteredProducts = [];
        let currentPage = 1;
        const itemsPerPage = 10;

        window.previewMedia = function (input, type, index) {
            const file = input.files[0];
            if (!file) return;
            const zone = type === 'img' ? document.getElementById(`zone-img-${index}`) : document.getElementById('zone-model');
            const preview = type === 'img' ? document.getElementById(`prev-img-${index}`) : document.getElementById('prev-model');

            if (type === 'img') {
                const reader = new FileReader();
                reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; zone.classList.add('has-file'); };
                reader.readAsDataURL(file);
            } else {
                preview.src = URL.createObjectURL(file); preview.style.display = 'block'; zone.classList.add('has-file');
            }
        }

        window.clearMedia = function (event, type, index) {
            event.stopPropagation();
            const input = type === 'img' ? document.getElementById(`file-img-${index}`) : document.getElementById('file-model');
            const zone = type === 'img' ? document.getElementById(`zone-img-${index}`) : document.getElementById('zone-model');
            const preview = type === 'img' ? document.getElementById(`prev-img-${index}`) : document.getElementById('prev-model');
            input.value = ""; preview.src = ""; preview.style.display = 'none'; zone.classList.remove('has-file');
        }

        document.addEventListener('DOMContentLoaded', async () => {
            await loadCategories();
            await fetchData();
            document.getElementById('create-product-btn').onclick = (e) => { e.preventDefault(); resetForm('THÊM MỚI'); showForm(); };
            document.getElementById('submit-form-btn-modal').onclick = handleFormSubmit;
            document.getElementById('btn-apply-filter').onclick = applyFilters;
            document.getElementById('btn-reset-filter').onclick = () => {
                document.getElementById('filter-search').value = ''; document.getElementById('filter-category').value = '';
                document.getElementById('filter-price-min').value = ''; document.getElementById('filter-price-max').value = '';
                applyFilters();
            };
        });

        async function loadCategories() {
            try {
                const res = await fetch(`${ADMIN_API}/categories`);
                const cats = await res.json();
                const selectModal = document.getElementById('product-category');
                const selectFilter = document.getElementById('filter-category');
                cats.forEach(c => {
                    categoryMap[c.id] = c.name;
                    const opt = `<option value="${c.id}">${c.name}</option>`;
                    selectModal.innerHTML += opt; selectFilter.innerHTML += opt;
                });
            } catch (err) { console.error(err); }
        }

        async function fetchData() {
            try {
                const res = await fetch(`${ADMIN_API}/products`);
                allProducts = await res.json();
                applyFilters();
            } catch (err) { console.error(err); }
        }

        function applyFilters() {
            const searchText = document.getElementById('filter-search').value.toLowerCase();
            const categoryId = document.getElementById('filter-category').value;
            const minPrice = parseFloat(document.getElementById('filter-price-min').value) || 0;
            const maxPrice = parseFloat(document.getElementById('filter-price-max').value) || Infinity;
            filteredProducts = allProducts.filter(p => {
                return p.name.toLowerCase().includes(searchText) && (categoryId === "" || p.category_id == categoryId) && (p.price >= minPrice && p.price <= maxPrice);
            });
            currentPage = 1; renderTable();
        }

        function renderTable() {
            const tbody = document.getElementById('product-list-body');
            document.getElementById('product-count-text').innerText = `${filteredProducts.length} Sản phẩm`;
            const start = (currentPage - 1) * itemsPerPage;
            const paginatedItems = filteredProducts.slice(start, start + itemsPerPage);
            tbody.innerHTML = '';
            paginatedItems.forEach(p => {
                let path = p.primary_image ? p.primary_image.replace(/\\/g, '/') : '';
                if (path.startsWith('/')) path = path.substring(1);
                const imgUrl = path ? `${PRODUCT_IMG_BASE}/${path}` : '{{ asset("images/no-image.png") }}';
                tbody.innerHTML += `<tr><td>${p.id}</td><td><div class="dash__table-img-wrap"><img class="u-img-fluid" src="${imgUrl}" onerror="this.src='{{ asset('images/no-image.png') }}'"></div></td>
                                                                                                                                                                            <td>${p.name}</td><td>${new Intl.NumberFormat('vi-VN').format(p.price)}đ</td><td>${p.quantity}</td>
                                                                                                                                                                            <td><span class="gl-label u-c-secondary">${categoryMap[p.category_id] || p.category_id}</span></td>
                                                                                                                                                                            <td><div class="dash__link dash__link--brand"><a href="#" onclick="editProduct(${p.id})">SỬA</a> | <a href="#" onclick="deleteProduct(${p.id})">XÓA</a></div></td></tr>`;
            });
            renderPagination();
        }

        function renderPagination() {
            const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
            const container = document.getElementById('pagination-controls'); container.innerHTML = '';
            if (totalPages <= 1) return;
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li'); li.innerText = i;
                if (i === currentPage) li.className = 'is-active';
                li.onclick = () => { currentPage = i; renderTable(); window.scrollTo(0, 0); };
                container.appendChild(li);
            }
        }

        window.resetForm = function (title, method = 'POST', id = null) {
            const form = document.getElementById('product-form');
            form.reset(); form.dataset.id = id;
            document.getElementById('form-title').innerText = title;
            document.getElementById('form-method').value = method;
            document.querySelectorAll('.upload-zone').forEach(zone => {
                zone.classList.remove('has-file');
                const img = zone.querySelector('img'); if (img) { img.src = ""; img.style.display = 'none'; }
                const model = zone.querySelector('model-viewer'); if (model) { model.src = ""; model.style.display = 'none'; }
            });
        }

        // --- HÀM ĐIỀU PHỐI CHÍNH ---
        async function handleFormSubmit() {
            const submitBtn = document.getElementById('submit-form-btn-modal');
            if (submitBtn.disabled) return;

            const productData = getProductFormData();
            if (!validateProductData(productData)) return;

            toggleSubmitState(true);

            try {
                const isEdit = document.getElementById('form-method').value === 'PUT';
                const form = document.getElementById('product-form');
                let productId = isEdit ? form.dataset.id : null;

                // BƯỚC 1: Nếu thêm mới, tạo SP cơ bản để lấy ID
                if (!isEdit) {
                    productId = await createBaseProduct(productData);
                    // Sau khi có ID, đóng form sớm để tránh nhấn nhiều lần (chống spam)
                    hideForm();
                }

                // BƯỚC 2: Upload file vật lý (Ghi đè/Xóa file trên ổ đĩa FE)
                const uploadPaths = await uploadMediaFiles(productId);

                // BƯỚC 3: Đồng bộ Database (Dùng chung logic cho cả Thêm/Sửa)
                await syncProductDatabase(productId, productData, uploadPaths, isEdit);

                alert(isEdit ? 'Cập nhật thành công!' : 'Thêm mới thành công!');
                if (isEdit) hideForm();
                fetchData();

            } catch (err) {
                console.error("Quy trình thất bại:", err);
                alert('Lỗi: ' + err.message);
                showForm();
            } finally {
                toggleSubmitState(false);
            }
        }

        // --- CÁC HÀM HỖ TRỢ ĐÃ TÁCH NHỎ ---

        function getProductFormData() {
            return {
                name: document.getElementById('product-name').value,
                price: parseFloat(document.getElementById('product-price').value),
                quantity: parseInt(document.getElementById('product-stock').value),
                category_id: document.getElementById('product-category').value,
                description: document.getElementById('product-description').value
            };
        }

        function validateProductData(data) {
            if (data.price < 10000) { alert("Giá từ 10.000đ!"); return false; }
            if (!document.getElementById('zone-img-0').classList.contains('has-file')) {
                alert("Bắt buộc phải có ảnh chính!"); return false;
            }
            return true;
        }

        function toggleSubmitState(isLoading) {
            const btn = document.getElementById('submit-form-btn-modal');
            btn.disabled = isLoading;
            btn.innerText = isLoading ? 'ĐANG XỬ LÝ...' : 'LƯU THÔNG TIN';
        }

        async function createBaseProduct(data) {
            const res = await fetch(`${ADMIN_API}/products`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await res.json();
            if (!result.ok) throw new Error(result.error);
            return result.id;
        }

        async function syncProductDatabase(id, data, paths, isEdit) {
            // A. Cập nhật bảng products chính (Tên, giá, mô tả, model_url)
            const productBody = { ...data };
            if (paths.model) productBody.model_url = paths.model;

            const resProd = await fetch(`${ADMIN_API}/products/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(productBody)
            });
            if (!resProd.ok) throw new Error("Không thể cập nhật bảng products.");

            // B. Đồng bộ 4 ô ảnh (Xử lý Xóa/Ghi đè/Thêm mới)
            for (let i = 0; i < 4; i++) {
                const zone = document.getElementById(`zone-img-${i}`);
                const displayOrder = i + 1;

                if (!zone.classList.contains('has-file')) {
                    // Ô TRỐNG: Xóa bản ghi trong DB (nếu có)
                    await fetch(`${ADMIN_API}/product_images/${id}/${displayOrder}`, { method: 'DELETE' });
                } else {
                    // CÓ ẢNH: Kiểm tra xem có phải ảnh mới vừa upload lên không
                    const newImg = paths.images.find(img => img.index == i);
                    if (newImg) {
                        // Ghi đè hoặc Tạo mới bằng UPSERT
                        await fetch(`${ADMIN_API}/product_images/upsert`, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                product_id: id,
                                image_url: newImg.url,
                                display_order: displayOrder,
                                is_primary: (i === 0 ? 1 : 0)
                            })
                        });
                    }
                }
            }
        }

        // --- HÀM THU THẬP FILE (DÙNG CHUNG CHO TẠO MỚI VÀ CHỈNH SỬA) ---
        async function uploadMediaFiles(productId) {
            const mediaData = new FormData();
            mediaData.append('product_id', productId);
            const modelFile = document.getElementById('file-model').files[0];
            if (modelFile) mediaData.append('model_file', modelFile);

            for (let i = 0; i < 4; i++) {
                const input = document.getElementById(`file-img-${i}`);
                if (input.files[0]) {
                    mediaData.append('images[]', input.files[0]);
                    mediaData.append('image_indices[]', i);
                }
            }
            const res = await fetch('/admin/local-upload-media', {
                method: 'POST',
                body: mediaData,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            return await res.json();
        }

        async function updateProductDatabase(id, data, paths, isEdit) {
            // Cập nhật thông tin chính (bao gồm model_url nếu có)
            const body = { ...data };
            if (paths.model) body.model_url = paths.model;

            await fetch(`${ADMIN_API}/products/${id}`, {
                method: isEdit ? 'PUT' : 'PUT', // Dùng PUT để cập nhật model_url cho SP mới tạo
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(body)
            });

            // Cập nhật từng ảnh (Upsert hoặc Delete nếu trống)
            for (let i = 0; i < 4; i++) {
                const zone = document.getElementById(`zone-img-${i}`);
                if (!zone.classList.contains('has-file')) {
                    await fetch(`${ADMIN_API}/product_images/${id}/${i + 1}`, { method: 'DELETE' });
                } else {
                    const newImg = paths.images.find(img => img.index === i);
                    if (newImg) {
                        await fetch(`${ADMIN_API}/product_images/upsert`, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                product_id: id,
                                image_url: newImg.url,
                                display_order: i + 1,
                                is_primary: (i === 0 ? 1 : 0)
                            })
                        });
                    }
                }
            }
        }

        window.editProduct = async function (id) {
            try {
                const res = await fetch(`${ADMIN_API}/products/${id}`);
                const p = await res.json();
                resetForm(`CHỈNH SỬA: ${p.name}`, 'PUT', id);

                document.getElementById('product-name').value = p.name;
                document.getElementById('product-price').value = p.price;
                document.getElementById('product-stock').value = p.quantity;
                document.getElementById('product-category').value = p.category_id;
                document.getElementById('product-description').value = p.description;

                // Load ảnh hiện có
                const imgRes = await fetch(`${ADMIN_API}/product_images/${id}`);
                const images = await imgRes.json();
                if (Array.isArray(images)) {
                    images.forEach(img => {
                        const idx = img.display_order - 1;
                        const zone = document.getElementById(`zone-img-${idx}`);
                        const prev = document.getElementById(`prev-img-${idx}`);
                        if (zone && prev) {
                            let path = img.image_url.replace(/\\/g, '/');
                            prev.src = `${PRODUCT_IMG_BASE}/${path}`;
                            prev.style.display = 'block';
                            zone.classList.add('has-file');
                        }
                    });
                }

                // Load model hiện có
                const mv = document.getElementById('prev-model');
                const mz = document.getElementById('zone-model');
                if (p.model_url) {
                    mv.src = `${PRODUCT_IMG_BASE}/${p.model_url.replace(/\\/g, '/')}`;
                    mv.style.display = 'block';
                    mz.classList.add('has-file');
                } else {
                    mv.src = "";
                    mv.style.display = 'none';
                    mz.classList.remove('has-file');
                }

                showForm();
            } catch (err) { alert('Lỗi tải dữ liệu'); }
        }

        window.deleteProduct = async function (id) {
            if (!confirm('Xác nhận xóa?')) return;
            try {
                const res = await fetch(`${ADMIN_API}/products/${id}`, { method: 'DELETE' });
                if (res.ok) fetchData();
            } catch (err) { console.error(err); }
        }

        window.showForm = () => document.getElementById('product-form-container').style.display = 'block';
        window.hideForm = () => document.getElementById('product-form-container').style.display = 'none';
    </script>
@endsection
