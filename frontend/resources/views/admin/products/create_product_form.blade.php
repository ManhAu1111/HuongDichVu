{{-- resources/views/admin/products/create_product_form.blade.php --}}

{{-- Thẻ dash__box được bỏ đi trong bước Modal trước --}}
<div class="dash__pad-2">
    <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">{{ isset($product) ? 'CHỈNH SỬA SẢN PHẨM' : 'THÊM SẢN PHẨM MỚI' }}</h1>
    <span class="dash__text u-s-m-b-30">Vui lòng nhập đầy đủ thông tin chi tiết sản phẩm.</span>

    <form class="l-f-o__form" method="POST" action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        {{-- THÊM CSS ĐỂ TẠO LƯỚI 2 CỘT --}}
        <style>
            .form-grid-layout {
                display: grid;
                grid-template-columns: repeat(2, 1fr); /* Chia thành 2 cột bằng nhau */
                gap: 20px; /* Khoảng cách giữa các cột và hàng */
            }
            /* Đảm bảo các trường lớn (textarea) chiếm hết chiều rộng (full span) */
            .form-grid-full-span {
                grid-column: 1 / -1;
            }
        </style>

        {{-- KHỐI CHỨA CÁC TRƯỜNG NHẬP LIỆU PHÂN CỘT --}}
        <div class="form-grid-layout">

            {{-- Cột 1: Tên Sản Phẩm --}}
            <div class="u-s-m-b-30">
                <label class="gl-label" for="product-name">TÊN SẢN PHẨM *</label>
                <input class="input-text input-text--primary-style" type="text" id="product-name" name="name" placeholder="Ví dụ: Ghế Sofa Bọc Da" value="{{ $product->name ?? '' }}" required>
            </div>

            {{-- Cột 2: Giá --}}
            <div class="u-s-m-b-30">
                <label class="gl-label" for="product-price">GIÁ (VND/USD) *</label>
                <input class="input-text input-text--primary-style" type="number" id="product-price" name="price" placeholder="Ví dụ: 5000000" value="{{ $product->price ?? '' }}" required>
            </div>

            {{-- Cột 3: URL Ảnh (Sử dụng lớp full-span để nó chiếm hết chiều rộng nếu cần) --}}
            <div class="u-s-m-b-30 form-grid-full-span">
                <label class="gl-label" for="product-image">URL ẢNH CHÍNH (hoặc upload file)</label>
                <input class="input-text input-text--primary-style" type="text" id="product-image" name="image_url" placeholder="http://..." value="{{ $product->image_url ?? '' }}">
            </div>

            {{-- Cột 4: Trạng Thái --}}
            <div class="u-s-m-b-30">
                <label class="gl-label" for="product-status">TRẠNG THÁI *</label>
                <select class="select-box select-box--primary-style" id="product-status" name="status">
                    <option value="active" {{ (isset($product) && $product->status == 'active') ? 'selected' : '' }}>Hoạt động</option>
                    <option value="draft" {{ (isset($product) && $product->status == 'draft') ? 'selected' : '' }}>Nháp</option>
                </select>
            </div>

            {{-- Vùng Mô Tả Chi Tiết (Chiếm toàn bộ chiều rộng) --}}
            <div class="u-s-m-b-30 form-grid-full-span">
                <label class="gl-label" for="product-description">MÔ TẢ CHI TIẾT *</label>
                <textarea class="text-area text-area--primary-style" id="product-description" name="description" required>{{ $product->description ?? '' }}</textarea>
            </div>

        </div>

        {{-- Nút Submit (Chiếm toàn bộ chiều rộng) --}}
        <div class="u-s-m-b-30">
            <button class="btn btn--e-brand-b-2" type="submit">{{ isset($product) ? 'CẬP NHẬT SẢN PHẨM' : 'THÊM SẢN PHẨM' }}</button>
        </div>
    </form>
</div>
