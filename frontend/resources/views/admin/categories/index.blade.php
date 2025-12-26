{{-- resources/views/admin/categories/index.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Quản Lý Danh Mục')

@section('admin_content')
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Danh Sách Danh Mục Sản Phẩm</h1>

            <div class="u-s-m-b-30 d-flex justify-content-between align-items-center">
                <button id="create-category-btn" class="btn btn--e-brand-b-2">
                    <i class="fas fa-plus u-s-m-r-6"></i> Thêm Danh Mục Mới
                </button>

                <div class="main-form" style="width: 40%;">
                    <input class="input-text input-text--border-radius input-text--style-1" type="text"
                        id="category-search-input" placeholder="Tìm kiếm tên danh mục...">
                </div>
            </div>

            <h2 class="dash__h2 u-s-p-xy-20" id="category-count-text">Đang tải...</h2>

            <div class="dash__table-wrap gl-scroll">
                <table class="dash__table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Danh Mục</th>
                            <th>Slug (URL)</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="category-list-body">
                        {{-- Dữ liệu sẽ đổ vào đây từ JS --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Nhúng Modal --}}
    @include('admin.categories.partials.modal_category')

    <script>
        const ADMIN_API = 'http://127.0.0.1:8007/api/admin'; 
        let allCategories = [];

        document.addEventListener('DOMContentLoaded', () => {
            fetchCategories();

            document.getElementById('create-category-btn').onclick = () => {
                resetCategoryForm('THÊM DANH MỤC MỚI', 'POST');
                showCategoryModal();
            };

            document.getElementById('category-search-input').oninput = function () {
                renderCategoryTable(this.value);
            };
        });

        // Hàm tạo Slug tự động
        window.generateSlug = function(text) {
            let slug = text.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[đĐ]/g, 'd')
                .replace(/([^0-9a-z-\s])/g, '')
                .replace(/(\s+)/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');

            const slugInput = document.getElementById('category-slug');
            if (slugInput) slugInput.value = slug;
        }

        async function fetchCategories() {
            try {
                // Gọi API từ admin-service cổng 8007
                const res = await fetch(`${ADMIN_API}/categories`);
                allCategories = await res.json();
                renderCategoryTable();
            } catch (err) {
                console.error("Lỗi tải danh mục:", err);
            }
        }

        function renderCategoryTable(search = '') {
            const tbody = document.getElementById('category-list-body');
            const filtered = allCategories.filter(c => c.name.toLowerCase().includes(search.toLowerCase()));

            document.getElementById('category-count-text').innerText = `${filtered.length} Danh mục tìm thấy`;
            tbody.innerHTML = '';

            filtered.forEach(c => {
                tbody.innerHTML += `
                    <tr>
                        <td>${c.id}</td>
                        <td><strong>${c.name}</strong></td>
                        <td><code style="color: #ff4500;">${c.slug || ''}</code></td>
                        <td>
                            <div class="dash__link dash__link--brand">
                                <a href="#" onclick="editCategory(${c.id}, '${c.name}', '${c.slug}')">SỬA</a> | 
                                <a href="#" onclick="deleteCategory(${c.id})">XÓA</a>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        window.showCategoryModal = () => document.getElementById('category-modal-container').style.display = 'block';
        window.hideCategoryModal = () => document.getElementById('category-modal-container').style.display = 'none';

        window.resetCategoryForm = (title, method, id = null) => {
            document.getElementById('category-form-title').innerText = title;
            document.getElementById('category-method').value = method;
            document.getElementById('category-id').value = id || '';
            document.getElementById('category-name').value = '';
            document.getElementById('category-slug').value = '';
        };

        window.editCategory = (id, name, slug) => {
            resetCategoryForm('CHỈNH SỬA DANH MỤC', 'PUT', id);
            document.getElementById('category-name').value = name;
            document.getElementById('category-slug').value = slug;
            showCategoryModal();
        };

        async function handleCategorySubmit() {
            const id = document.getElementById('category-id').value;
            const method = document.getElementById('category-method').value;
            const name = document.getElementById('category-name').value;
            const slug = document.getElementById('category-slug').value;

            if (!name || !slug) return alert("Vui lòng nhập đầy đủ Tên và Slug!");

            const url = method === 'POST' ? `${ADMIN_API}/categories` : `${ADMIN_API}/categories/${id}`;

            try {
                const res = await fetch(url, {
                    method: method,
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name: name, slug: slug })
                });

                if (res.ok) {
                    alert("Thao tác thành công!");
                    hideCategoryModal();
                    fetchCategories();
                } else {
                    const errorData = await res.json();
                    alert("Lỗi: " + (errorData.message || "Không thể lưu danh mục"));
                }
            } catch (err) { 
                alert("Lỗi kết nối service"); 
            }
        }

        async function deleteCategory(id) {
            if (!confirm("Xác nhận xóa danh mục này? Các sản phẩm thuộc danh mục này có thể bị ảnh hưởng.")) return;
            try {
                const res = await fetch(`${ADMIN_API}/categories/${id}`, { method: 'DELETE' });
                if (res.ok) {
                    fetchCategories();
                } else {
                    alert("Không thể xóa danh mục này.");
                }
            } catch (err) { console.error(err); }
        }
    </script>
@endsection