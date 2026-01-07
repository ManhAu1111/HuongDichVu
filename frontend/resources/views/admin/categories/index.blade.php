{{-- resources/views/admin/categories/index.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Quản Lý Danh Mục')

@section('admin_content')
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <div class="d-flex justify-content-between align-items-center u-s-m-b-20">
                <div>
                    <h1 class="dash__h1 u-s-m-b-8 u-c-secondary">Quản Lý Danh Mục</h1>
                    <span class="dash__text">Phân loại sản phẩm giúp khách hàng tìm kiếm dễ dàng hơn.</span>
                </div>
                <button id="create-category-btn" class="btn btn--e-brand-b-2"
                    style="border-radius: 50px; padding: 12px 25px;">
                    <i class="fas fa-plus u-s-m-r-6"></i> THÊM MỚI
                </button>
            </div>

            <hr class="u-s-m-b-30" style="border-top: 1px solid #f1f1f1;">

            {{-- TOOL BAR --}}
            <div class="row align-items-center u-s-m-b-30">
                <div class="col-lg-6 col-md-12">
                    <div class="main-form" style="position: relative;">
                        <i class="fas fa-search"
                            style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #bbb;"></i>
                        <input class="input-text input-text--border-radius input-text--style-1" type="text"
                            id="category-search-input" placeholder="Tìm kiếm theo tên danh mục..."
                            style="padding-left: 40px; height: 45px;">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 text-right mt-2 mt-lg-0">
                    <h2 class="dash__h2" id="category-count-text" style="color: #777; font-weight: 400;">Đang tính toán...
                    </h2>
                </div>
            </div>

            {{-- TABLE AREA --}}
            <div class="dash__table-wrap gl-scroll" style="border: 1px solid #f1f1f1; border-radius: 8px;">
                <table class="dash__table">
                    <thead style="background-color: #fafafa;">
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Tên Danh Mục</th>
                            <th>Slug (Đường dẫn tĩnh)</th>
                            <th style="width: 200px; text-align: center;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="category-list-body">
                        {{-- Loading Spinner --}}
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 50px;">
                                <div class="spinner-border text-primary" role="status"></div>
                                <div class="u-s-m-t-10">Đang tải dữ liệu...</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- EMPTY STATE --}}
            <div id="empty-state" style="display:none; text-align: center; padding: 50px;">
                <i class="fas fa-folder-open u-s-m-b-16" style="font-size: 48px; color: #ddd;"></i>
                <h3 class="dash__h3">Không tìm thấy danh mục nào</h3>
                <p class="dash__text">Hãy thử thay đổi từ khóa tìm kiếm hoặc thêm danh mục mới.</p>
            </div>
        </div>
    </div>

    @include('admin.categories.partials.modal_category')

    <style>
        .badge-slug {
            background-color: #f8f9fa;
            color: #ff4500;
            padding: 4px 10px;
            border-radius: 4px;
            border: 1px solid #eee;
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
        }

        .dash__table tbody tr:hover {
            background-color: #fcfcfc;
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-edit {
            color: #007bff;
            border: 1px solid #007bff;
        }

        .btn-edit:hover {
            background: #007bff;
            color: #fff;
        }

        .btn-delete {
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        .btn-delete:hover {
            background: #dc3545;
            color: #fff;
        }
    </style>

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

        // Tự động tạo slug khi nhập tên (trong Modal)
        window.handleNameInput = function (nameValue) {
            const slug = nameValue.toLowerCase()
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
                const res = await fetch(`${ADMIN_API}/categories`);
                allCategories = await res.json();
                renderCategoryTable();
            } catch (err) {
                console.error("Lỗi tải danh mục:", err);
                document.getElementById('category-list-body').innerHTML = '<tr><td colspan="4" class="text-center text-danger">Không thể kết nối đến máy chủ.</td></tr>';
            }
        }

        function renderCategoryTable(search = '') {
            const tbody = document.getElementById('category-list-body');
            const emptyState = document.getElementById('empty-state');
            const filtered = allCategories.filter(c => c.name.toLowerCase().includes(search.toLowerCase()));

            document.getElementById('category-count-text').innerText = `${filtered.length} Danh mục`;
            tbody.innerHTML = '';

            if (filtered.length === 0) {
                emptyState.style.display = 'block';
                return;
            }

            emptyState.style.display = 'none';
            filtered.forEach(c => {
                tbody.innerHTML += `
                            <tr>
                                <td style="color: #bbb; font-size: 12px;">#${c.id}</td>
                                <td><span style="font-weight: 500; color: #333;">${c.name}</span></td>
                                <td style="color: #888; font-style: italic; font-size: 13px;">${c.slug || ''}</td>
                                <td style="text-align: center;">
                                    <div class="dash__link dash__link--brand">
                                        <a href="javascript:void(0)" onclick="editCategory(${c.id}, '${c.name}', '${c.slug}')" style="font-size: 13px;">SỬA</a>
                                        <span style="margin: 0 5px; color: #eee;">|</span>
                                        <a href="javascript:void(0)" onclick="deleteCategory(${c.id})" style="font-size: 13px; color: #666;">XÓA</a>
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
            const method = document.getElementById('category-method').value; // 'POST' hoặc 'PUT'
            const name = document.getElementById('category-name').value;
            const slug = document.getElementById('category-slug').value;

            if (!name || !slug) return alert("Vui lòng nhập đầy đủ Tên và Slug!");

            // Xác định URL: POST thì gửi đến /categories, PUT thì gửi đến /categories/{id}
            const url = method === 'POST'
                ? `${ADMIN_API}/categories`
                : `${ADMIN_API}/categories/${id}`;

            try {
                const res = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ name: name, slug: slug })
                });

                const data = await res.json();

                if (res.ok) {
                    alert(method === 'POST' ? "Thêm danh mục thành công!" : "Cập nhật thành công!");
                    hideCategoryModal();
                    fetchCategories(); // Tải lại danh sách
                } else {
                    alert("Lỗi: " + (data.message || "Thao tác thất bại"));
                }
            } catch (err) {
                console.error(err);
                alert("Lỗi kết nối API");
            }
        }

        async function deleteCategory(id) {
            if (!confirm("Bạn có chắc chắn muốn xóa danh mục này? Hệ thống sẽ kiểm tra xem có sản phẩm nào thuộc danh mục này không trước khi xóa.")) {
                return;
            }

            try {
                const res = await fetch(`${ADMIN_API}/categories/${id}`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json' }
                });

                const data = await res.json();

                if (res.ok && data.ok) {
                    alert("Xóa danh mục thành công!");
                    fetchCategories();
                } else {
                    // Hiển thị lỗi từ Product Service (Ví dụ: "Không thể xóa: Danh mục đang chứa sản phẩm")
                    alert("Không thể xóa: " + (data.message || "Lỗi không xác định"));
                }
            } catch (err) {
                console.error(err);
                alert("Lỗi khi kết nối đến máy chủ.");
            }
        }

        window.generateSlug = function (text) {
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
    </script>
@endsection
