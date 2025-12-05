{{-- resources/views/admin/products/create_edit.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Thêm/Sửa Sản Phẩm')

@section('admin_content')

<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">{{ isset($product) ? 'CHỈNH SỬA SẢN PHẨM' : 'THÊM SẢN PHẨM MỚI' }}</h1>
        <span class="dash__text u-s-m-b-30">Vui lòng nhập đầy đủ thông tin chi tiết sản phẩm.</span>

        <form class="l-f-o__form" method="POST" action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}">
            @csrf
            {{-- Giả định có method PUT cho cập nhật --}}
            @if(isset($product))
                @method('PUT')
            @endif

            <div class="u-s-m-b-30">
                <label class="gl-label" for="product-name">TÊN SẢN PHẨM *</label>
                <input class="input-text input-text--primary-style" type="text" id="product-name" name="name" placeholder="Ví dụ: Ghế Sofa Bọc Da" value="{{ $product->name ?? '' }}" required>
            </div>

            <div class="u-s-m-b-30">
                <label class="gl-label" for="product-price">GIÁ (VND/USD) *</label>
                <input class="input-text input-text--primary-style" type="number" id="product-price" name="price" placeholder="Ví dụ: 5000000" value="{{ $product->price ?? '' }}" required>
            </div>

            <div class="u-s-m-b-30">
                <label class="gl-label" for="product-description">MÔ TẢ CHI TIẾT *</label>
                <textarea class="text-area text-area--primary-style" id="product-description" name="description" required>{{ $product->description ?? '' }}</textarea>
            </div>

            <div class="u-s-m-b-30">
                <label class="gl-label" for="product-image">URL ẢNH CHÍNH (hoặc upload file)</label>
                <input class="input-text input-text--primary-style" type="text" id="product-image" name="image_url" placeholder="http://..." value="{{ $product->image_url ?? '' }}">
            </div>

            <div class="u-s-m-b-30">
                <label class="gl-label" for="product-status">TRẠNG THÁI *</label>
                <select class="select-box select-box--primary-style" id="product-status" name="status">
                    <option value="active" {{ (isset($product) && $product->status == 'active') ? 'selected' : '' }}>Hoạt động</option>
                    <option value="draft" {{ (isset($product) && $product->status == 'draft') ? 'selected' : '' }}>Nháp</option>
                </select>
            </div>

            <div class="u-s-m-b-30">
                <button class="btn btn--e-brand-b-2" type="submit">{{ isset($product) ? 'CẬP NHẬT SẢN PHẨM' : 'THÊM SẢN PHẨM' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
