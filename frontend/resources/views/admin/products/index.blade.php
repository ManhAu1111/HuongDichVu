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

        .form-grid-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-grid-full-span {
            grid-column: 1 / -1;
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

    <script>
        const ADMIN_API = 'http://127.0.0.1:8005/api/admin';
        const PRODUCT_IMG_BASE = 'http://127.0.0.1:8000';

        let categoryMap = {};
        let allProducts = []; // Lưu trữ toàn bộ để lọc Client-side (hoặc gọi API nếu Product Service hỗ trợ query)
        let filteredProducts = [];
        let currentPage = 1;
        const itemsPerPage = 10;

        document.addEventListener('DOMContentLoaded', async () => {
            await loadCategories();
            await fetchData();

            // Sự kiện Lọc
            document.getElementById('btn-apply-filter').addEventListener('click', applyFilters);
            document.getElementById('btn-reset-filter').addEventListener('click', () => {
                document.getElementById('filter-search').value = '';
                document.getElementById('filter-category').value = '';
                document.getElementById('filter-price-min').value = '';
                document.getElementById('filter-price-max').value = '';
                applyFilters();
            });

            // Gắn sự kiện Modal (giống code cũ của bạn)
            document.getElementById('create-product-btn').onclick = (e) => { e.preventDefault(); resetForm('THÊM MỚI'); showForm(); };
            document.getElementById('submit-form-btn-modal').onclick = handleFormSubmit;
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
                    selectModal.innerHTML += opt;
                    selectFilter.innerHTML += opt;
                });
            } catch (err) { console.error(err); }
        }

        async function fetchData() {
            try {
                const res = await fetch(`${ADMIN_API}/products`);
                allProducts = await res.json();
                applyFilters(); // Thêm dòng này để bảng tự vẽ lại sau khi lấy dữ liệu mới
            } catch (err) {
                console.error('Lỗi lấy dữ liệu:', err);
            }
        }

        function applyFilters() {
            const searchText = document.getElementById('filter-search').value.toLowerCase();
            const categoryId = document.getElementById('filter-category').value;
            const minPrice = parseFloat(document.getElementById('filter-price-min').value) || 0;
            const maxPrice = parseFloat(document.getElementById('filter-price-max').value) || Infinity;

            filteredProducts = allProducts.filter(p => {
                const matchName = p.name.toLowerCase().includes(searchText);
                const matchCat = categoryId === "" || p.category_id == categoryId;
                const matchPrice = p.price >= minPrice && p.price <= maxPrice;
                return matchName && matchCat && matchPrice;
            });

            currentPage = 1; // Reset về trang 1 khi lọc
            renderTable();
        }

        function renderTable() {
            const tbody = document.getElementById('product-list-body');
            document.getElementById('product-count-text').innerText = `${filteredProducts.length} Sản phẩm tìm thấy`;

            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedItems = filteredProducts.slice(start, end);

            tbody.innerHTML = '';
            paginatedItems.forEach(p => {
                // 1. Chuyển \ thành /
                let path = p.primary_image ? p.primary_image.replace(/\\/g, '/') : '';

                // 2. Xóa dấu / ở đầu nếu có (tránh lỗi 8000//uploads)
                if (path.startsWith('/')) path = path.substring(1);

                // 3. Nối URL trỏ về Port 8000
                const imgUrl = path ? `${PRODUCT_IMG_BASE}/${path}` : '{{ asset("images/no-image.png") }}';

                tbody.innerHTML += `
                <tr>
                    <td>${p.id}</td>
                    <td>
                        <div class="dash__table-img-wrap">
                            <img class="u-img-fluid" src="${imgUrl}"
                                 onerror="this.src='{{ asset('images/no-image.png') }}'">
                        </div>
                    </td>
                    <td>${p.name}</td>
                    <td>${new Intl.NumberFormat('vi-VN').format(p.price)}đ</td>
                    <td>${p.quantity}</td>
                    <td><span class="gl-label u-c-secondary">${categoryMap[p.category_id] || p.category_id}</span></td>
                    <td>
                        <div class="dash__link dash__link--brand">
                            <a href="#" onclick="editProduct(${p.id})">SỬA</a> |
                            <a href="#" onclick="deleteProduct(${p.id})">XÓA</a>
                        </div>
                    </td>
                </tr>`;
            });
            renderPagination();
        }

        function renderPagination() {
            const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
            const container = document.getElementById('pagination-controls');
            container.innerHTML = '';

            if (totalPages <= 1) return;

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.innerText = i;
                if (i === currentPage) li.className = 'is-active';
                li.onclick = () => { currentPage = i; renderTable(); window.scrollTo(0, 0); };
                container.appendChild(li);
            }
        }

        // async function loadProducts() {
        //     try {
        //         const res = await fetch(`${ADMIN_API}/products`);
        //         const products = await res.json();
        //         const tbody = document.getElementById('product-list-body');
        //         document.getElementById('product-count-text').innerText = `${products.length} Sản Phẩm Tìm Thấy`;

        //         tbody.innerHTML = '';
        //         products.forEach(p => {
        //             const imgUrl = p.primary_image ? `${PRODUCT_IMG_BASE}/${p.primary_image.replace(/\\/g, '/')}` : '';

        //             // Tra cứu tên từ Map đã được load ở hàm trên
        //             const categoryName = categoryMap[p.category_id] || `ID: ${p.category_id}`;

        //             tbody.innerHTML += `
        //                     <tr>
        //                         <td>${p.id}</td>
        //                         <td>
        //                             <div class="dash__table-img-wrap">
        //                                 <img class="u-img-fluid" src="${imgUrl}" alt="">
        //                             </div>
        //                         </td>
        //                         <td>${p.name}</td>
        //                         <td>${new Intl.NumberFormat('vi-VN').format(p.price)} VND</td>
        //                         <td>${p.quantity}</td>
        //                         <td><span class="gl-label u-c-secondary">${categoryName}</span></td>
        //                         <td>
        //                             <div class="dash__link dash__link--brand">
        //                                 <a href="#" onclick="editProduct(${p.id})">SỬA</a> |
        //                                 <a href="#" onclick="deleteProduct(${p.id})">XÓA</a>
        //                             </div>
        //                         </td>
        //                     </tr>`;
        //         });
        //     } catch (err) {
        //         console.error('Lỗi load sản phẩm:', err);
        //     }
        // }

        async function editProduct(id) {
            try {
                const res = await fetch(`${ADMIN_API}/products/${id}`);
                const p = await res.json();
                resetForm(`CHỈNH SỬA SẢN PHẨM: ID ${p.id}`, 'PUT', id);

                document.getElementById('product-name').value = p.name;
                document.getElementById('product-price').value = p.price;
                document.getElementById('product-stock').value = p.quantity;
                document.getElementById('product-category').value = p.category_id;
                document.getElementById('product-description').value = p.description;
                document.getElementById('image-file-name').innerText = 'Giữ file cũ nếu không chọn mới';

                showForm();
            } catch (err) { alert('Không thể lấy dữ liệu sản phẩm'); }
        }

        async function handleFormSubmit() {
            const form = document.getElementById('product-form');
            const formData = new FormData(form);
            const method = document.getElementById('form-method').value;
            const id = form.dataset.id;

            let url = `${ADMIN_API}/products`;
            if (method === 'PUT') {
                url = `${ADMIN_API}/products/${id}`;
                formData.append('_method', 'PUT');
            }

            try {
                const res = await fetch(url, { method: 'POST', body: formData });
                if (res.ok) {
                    alert('Lưu thành công!');
                    hideForm();
                    loadProducts();
                } else {
                    alert('Lỗi khi lưu dữ liệu');
                }
            } catch (err) { console.error(err); }
        }

        async function deleteProduct(id) {
            if (!confirm('Xác nhận xóa sản phẩm này?')) return;
            try {
                const res = await fetch(`${ADMIN_API}/products/${id}`, { method: 'DELETE' });
                if (res.ok) { loadProducts(); }
            } catch (err) { console.error(err); }
        }

        function showForm() { document.getElementById('product-form-container').style.display = 'block'; }
        function hideForm() { document.getElementById('product-form-container').style.display = 'none'; }

        function resetForm(title, method = 'POST', id = null) {
            const form = document.getElementById('product-form');
            form.reset();
            form.dataset.id = id;
            document.getElementById('form-title').innerText = title;
            document.getElementById('form-method').value = method;
            document.getElementById('form-submit-text').innerText = method === 'POST' ? 'THÊM SẢN PHẨM' : 'CẬP NHẬT SẢN PHẨM';
            document.getElementById('image-file-name').innerText = 'Chưa chọn tệp';
            document.getElementById('model-file-name').innerText = 'Chưa chọn tệp';
        }
    </script>
@endsection
