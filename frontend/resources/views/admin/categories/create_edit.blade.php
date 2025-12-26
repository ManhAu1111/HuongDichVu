{{-- resources/views/admin/categories/create_edit.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Thêm/Sửa Danh Mục')

@section('admin_content')

<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">{{ isset($category) ? 'CHỈNH SỬA DANH MỤC' : 'THÊM DANH MỤC MỚI' }}</h1>
        <span class="dash__text u-s-m-b-30">Vui lòng nhập đầy đủ thông tin danh mục.</span>

        {{-- Giả định biến $category được truyền từ controller --}}
        <form class="l-f-o__form" method="POST" action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
            @csrf
            {{-- Giả định có method PUT cho cập nhật --}}
            @if(isset($category))
                @method('PUT')
            @endif

            <div class="u-s-m-b-30">
                <label class="gl-label" for="category-name">TÊN DANH MỤC *</label>
                <input class="input-text input-text--primary-style" type="text" id="category-name" name="name" placeholder="Ví dụ: Đồ Điện Tử" value="{{ $category->name ?? '' }}" required>
            </div>

            <div class="u-s-m-b-30">
                <label class="gl-label" for="category-slug">SLUG (Tên không dấu, cách nhau bằng gạch ngang)</label>
                <input class="input-text input-text--primary-style" type="text" id="category-slug" name="slug" placeholder="Ví dụ: do-dien-tu" value="{{ $category->slug ?? '' }}">
            </div>

            <div class="u-s-m-b-30">
                <label class="gl-label" for="category-status">TRẠNG THÁI *</label>
                <select class="select-box select-box--primary-style" id="category-status" name="status">
                    <option value="active" {{ (isset($category) && $category->status == 'active') ? 'selected' : '' }}>Hoạt động</option>
                    <option value="draft" {{ (isset($category) && $category->status == 'draft') ? 'selected' : '' }}>Nháp</option>
                </select>
            </div>

            <div class="u-s-m-b-30">
                <button class="btn btn--e-brand-b-2" type="submit">{{ isset($category) ? 'CẬP NHẬT DANH MỤC' : 'THÊM DANH MỤC' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
