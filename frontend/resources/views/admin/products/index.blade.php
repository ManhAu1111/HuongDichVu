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

<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js"></script>
<script>
    const ADMIN_API = 'http://127.0.0.1:8007/api/admin';
    const PRODUCT_IMG_BASE = 'http://127.0.0.1:8000';

    let categoryMap = {};
    let allProducts = [];
    let filteredProducts = [];
    let currentPage = 1;
    const itemsPerPage = 10;

    window.previewMedia = function(input, type, index) {
        const file = input.files[0];
        if (!file) return;
        const zone = type === 'img' ? document.getElementById(`zone-img-${index}`) : document.getElementById(
            'zone-model');
        const preview = type === 'img' ? document.getElementById(`prev-img-${index}`) : document.getElementById(
            'prev-model');

        if (type === 'img') {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
                zone.classList.add('has-file');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            zone.classList.add('has-file');
        }
    }

    window.clearMedia = function(event, type, index) {
        event.stopPropagation();
        const input = type === 'img' ? document.getElementById(`file-img-${index}`) : document.getElementById(
            'file-model');
        const zone = type === 'img' ? document.getElementById(`zone-img-${index}`) : document.getElementById(
            'zone-model');
        const preview = type === 'img' ? document.getElementById(`prev-img-${index}`) : document.getElementById(
            'prev-model');
        input.value = "";
        preview.src = "";
        preview.style.display = 'none';
        zone.classList.remove('has-file');
    }

    document.addEventListener('DOMContentLoaded', async () => {
        await loadCategories();
        await fetchData();
        document.getElementById('create-product-btn').onclick = (e) => {
            e.preventDefault();
            resetForm('THÊM MỚI');
            showForm();
        };
        document.getElementById('submit-form-btn-modal').onclick = handleFormSubmit;
        document.getElementById('btn-apply-filter').onclick = applyFilters;
        document.getElementById('btn-reset-filter').onclick = () => {
            document.getElementById('filter-search').value = '';
            document.getElementById('filter-category').value = '';
            document.getElementById('filter-price-min').value = '';
            document.getElementById('filter-price-max').value = '';
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
                selectModal.innerHTML += opt;
                selectFilter.innerHTML += opt;
            });
        } catch (err) {
            console.error(err);
        }
    }

    async function fetchData() {
        try {
            const res = await fetch(`${ADMIN_API}/products`);
            allProducts = await res.json();
            applyFilters();
        } catch (err) {
            console.error(err);
        }
    }

    function applyFilters() {
        const searchText = document.getElementById('filter-search').value.toLowerCase();
        const categoryId = document.getElementById('filter-category').value;
        const minPrice = parseFloat(document.getElementById('filter-price-min').value) || 0;
        const maxPrice = parseFloat(document.getElementById('filter-price-max').value) || Infinity;
        filteredProducts = allProducts.filter(p => {
            return p.name.toLowerCase().includes(searchText) && (categoryId === "" || p.category_id ==
                categoryId) && (p.price >= minPrice && p.price <= maxPrice);
        });
        currentPage = 1;
        renderTable();
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
            tbody.innerHTML +=
                `<tr><td>${p.id}</td><td><div class="dash__table-img-wrap"><img class="u-img-fluid" src="${imgUrl}" onerror="this.src='{{ asset('images/no-image.png') }}'"></div></td>
                                                                                                                <td>${p.name}</td><td>${new Intl.NumberFormat('vi-VN').format(p.price)}đ</td><td>${p.quantity}</td>
                                                                                                                <td><span class="gl-label u-c-secondary">${categoryMap[p.category_id] || p.category_id}</span></td>
                                                                                                                <td><div class="dash__link dash__link--brand"><a href="#" onclick="editProduct(${p.id})">SỬA</a> | <a href="#" onclick="deleteProduct(${p.id})">XÓA</a></div></td></tr>`;
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
            li.onclick = () => {
                currentPage = i;
                renderTable();
                window.scrollTo(0, 0);
            };
            container.appendChild(li);
        }
    }

    window.resetForm = function(title, method = 'POST', id = null) {
        const form = document.getElementById('product-form');
        form.reset();
        form.dataset.id = id;
        document.getElementById('form-title').innerText = title;
        document.getElementById('form-method').value = method;
        document.querySelectorAll('.upload-zone').forEach(zone => {
            zone.classList.remove('has-file');
            const img = zone.querySelector('img');
            if (img) {
                img.src = "";
                img.style.display = 'none';
            }
            const model = zone.querySelector('model-viewer');
            if (model) {
                model.src = "";
                model.style.display = 'none';
            }
        });
    }

    // --- LOGIC XỬ LÝ SUBMIT MỚI (4 BƯỚC) ---
    // --- LOGIC XỬ LÝ SUBMIT MỚI (4 BƯỚC + CHỐNG SPAM) ---
    async function handleFormSubmit() {
        const submitBtn = document.getElementById('submit-form-btn-modal');
        const form = document.getElementById('product-form');
        const isEdit = document.getElementById('form-method').value === 'PUT';
        const mainImgZone = document.getElementById('zone-img-0');
        const price = parseFloat(document.getElementById('product-price').value);
        const stock = parseInt(document.getElementById('product-stock').value);

        if (price < 10000) {
            alert("Giá sản phẩm phải ít nhất là 10.000đ!");
            return;
        }

        if (stock < 0) {
            alert("Số lượng kho hàng không được phép âm!");
            return;
        }

        if (submitBtn.disabled) return;

        if (!mainImgZone.classList.contains('has-file')) {
            alert("Bắt buộc phải có Ảnh Chính!");
            return;
        }

        submitBtn.disabled = true;
        const originalText = submitBtn.innerText;
        submitBtn.innerText = 'ĐANG XỬ LÝ...';

        try {
            if (!isEdit) {
                // --- LUỒNG THÊM MỚI (Giữ nguyên 4 bước của bạn) ---
                // Bước 1: Tạo SP cơ bản
                const basicData = {
                    name: document.getElementById('product-name').value,
                    price: document.getElementById('product-price').value,
                    quantity: document.getElementById('product-stock').value,
                    category_id: document.getElementById('product-category').value,
                    description: document.getElementById('product-description').value
                };

                const res = await fetch(`${ADMIN_API}/products`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(basicData)
                });
                const result = await res.json();
                if (!result.ok) throw new Error(result.error || 'Lỗi tạo SP');
                const newId = result.id;

                hideForm();

                // Bước 2: Upload file vật lý (Frontend xử lý)
                const mediaData = new FormData();
                mediaData.append('product_id', newId);
                const modelFile = document.getElementById('file-model').files[0];
                if (modelFile) mediaData.append('model_file', modelFile);
                for (let i = 0; i < 4; i++) {
                    const imgFile = document.getElementById(`file-img-${i}`).files[0];
                    if (imgFile) mediaData.append('images[]', imgFile);
                }

                const uploadRes = await fetch('/admin/local-upload-media', {
                    method: 'POST',
                    body: mediaData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                if (!uploadRes.ok) throw new Error('Lỗi upload file vật lý');
                const paths = await uploadRes.json();

                // Bước 3: Cập nhật model_url vào DB (Sử dụng API chung products/{id})
                if (paths.model) {
                    await fetch(`${ADMIN_API}/products/${newId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            model_url: paths.model
                        })
                    });
                }

                // Bước 4: Lưu danh sách ảnh vào DB
                if (paths.images && paths.images.length > 0) {
                    for (const [index, img] of paths.images.entries()) {
                        await fetch(`${ADMIN_API}/product_images`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                product_id: newId,
                                image_url: img.url,
                                is_primary: img.is_primary,
                                display_order: index + 1
                            })
                        });
                    }
                }
                alert('Thêm sản phẩm thành công!');

            } else {
                // --- LUỒNG CHỈNH SỬA (ĐÃ TỐI ƯU) ---
                const id = form.dataset.id;

                // 1. Xử lý File vật lý trước để lấy path mới (nếu có thay đổi)
                const mediaData = new FormData();
                mediaData.append('product_id', id);
                const modelFile = document.getElementById('file-model').files[0];
                if (modelFile) mediaData.append('model_file', modelFile);
                // (Thêm logic xử lý ảnh nếu bạn muốn cập nhật ảnh vật lý tại đây)

                let newModelPath = null;
                if (modelFile) {
                    const uploadRes = await fetch('/admin/local-upload-media', {
                        method: 'POST',
                        body: mediaData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    const paths = await uploadRes.json();
                    newModelPath = paths.model;
                }

                // 2. Gộp tất cả dữ liệu vào 1 lần gọi PUT duy nhất
                const updateData = {
                    name: document.getElementById('product-name').value,
                    price: document.getElementById('product-price').value,
                    quantity: document.getElementById('product-stock').value,
                    category_id: document.getElementById('product-category').value,
                    description: document.getElementById('product-description').value
                };

                // Nếu có path model mới từ bước upload, đưa vào body luôn
                if (newModelPath) {
                    updateData.model_url = newModelPath;
                }

                const res = await fetch(`${ADMIN_API}/products/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(updateData)
                });

                if (res.ok) {
                    alert('Cập nhật sản phẩm thành công!');
                    hideForm();
                } else {
                    throw new Error('Lỗi khi cập nhật dữ liệu lên Server');
                }
            }
            fetchData();
        } catch (err) {
            console.error("Lỗi:", err);
            alert('Đã xảy ra lỗi: ' + err.message);
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerText = originalText;
        }
    }

    window.editProduct = async function(id) {
        try {
            const res = await fetch(`${ADMIN_API}/products/${id}`);
            const p = await res.json();
            resetForm(`CHỈNH SỬA: ${p.name}`, 'PUT', id);
            document.getElementById('product-name').value = p.name;
            document.getElementById('product-price').value = p.price;
            document.getElementById('product-stock').value = p.quantity;
            document.getElementById('product-category').value = p.category_id;
            document.getElementById('product-description').value = p.description;

            const imgRes = await fetch(`${ADMIN_API}/product_images/${id}`);
            const productImages = await imgRes.json();
            if (Array.isArray(productImages)) {
                productImages.forEach((img, index) => {
                    if (index < 4 && img && img.image_url) {
                        const zone = document.getElementById(`zone-img-${index}`);
                        const prev = document.getElementById(`prev-img-${index}`);
                        let path = img.image_url.replace(/\\/g, '/');
                        if (path.startsWith('/')) path = path.substring(1);
                        prev.src = `${PRODUCT_IMG_BASE}/${path}`;
                        prev.style.display = 'block';
                        zone.classList.add('has-file');
                    }
                });
            }
            if (p.model_url) {
                const zone = document.getElementById('zone-model');
                const prev = document.getElementById('prev-model');
                let modelPath = p.model_url.replace(/\\/g, '/');
                if (modelPath.startsWith('/')) modelPath = modelPath.substring(1);
                prev.src = `${PRODUCT_IMG_BASE}/${modelPath}`;
                prev.style.display = 'block';
                zone.classList.add('has-file');
            }
            showForm();
        } catch (err) {
            console.error(err);
            alert('Lỗi tải dữ liệu sản phẩm');
        }
    }

    window.deleteProduct = async function(id) {
        if (!confirm('Xác nhận xóa?')) return;
        try {
            const res = await fetch(`${ADMIN_API}/products/${id}`, {
                method: 'DELETE'
            });
            if (res.ok) fetchData();
        } catch (err) {
            console.error(err);
        }
    }

    window.showForm = () => document.getElementById('product-form-container').style.display = 'block';
    window.hideForm = () => document.getElementById('product-form-container').style.display = 'none';
</script>
@endsection