{{-- 1. Kế thừa file layout chính --}}
@extends('layouts.app')

{{-- 2. Đặt tiêu đề riêng cho trang này (sẽ thay thế @yield('title')) --}}
{{-- Trong thực tế, bạn sẽ dùng biến động: @section('title', $post->title) --}}
@section('title', 'Ludus - Chi Tiết Bài Viết')


{{-- 3. Bắt đầu phần nội dung (sẽ thay thế @yield('content')) --}}
@section('content')
@php
$wishlistItems = $wishlistItems ?? [];
@endphp
<div class="app-content">

    <!--====== Section 1 ======-->
    <div class="u-s-p-y-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">

                                <a href="{{ route('shop.index') }}">Trang Chủ</a>
                            </li>
                            <li class="is-marked">

                                <a href="{{ route('wishlist') }}">Danh Sách Yêu Thích</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->


    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">DANH SÁCH YÊU THÍCH</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        @if (count($wishlistItems) === 0)
                        <div class="text-center u-s-p-y-60">
                            <h4>Danh sách yêu thích đang trống</h4>
                        </div>
                        @else
                        @foreach ($wishlistItems as $item)
                        <div class="w-r u-s-m-b-30">
                            <div class="w-r__container">
                                <div class="w-r__wrap-1">
                                    <div class="w-r__img-wrap">
                                        <img class="u-img-fluid"
                                            src="{{ config('services.product.image_url') }}/{{ $item['primary_image'] }}">
                                    </div>

                                    <div class="w-r__info">
                                        <span class="w-r__name">
                                            <a href="{{ route('products.detail', $item['id']) }}">
                                                {{ $item['name'] }}
                                            </a>
                                        </span>

                                        <span class="w-r__category">
                                            Mã danh mục: {{ $item['category_id'] }}
                                        </span>

                                        <span class="w-r__price">
                                            {{ number_format((float) $item['price']) }}đ
                                        </span>
                                    </div>
                                </div>

                                <div class="w-r__wrap-2">
                                    <a class="w-r__link btn--e-transparent-platinum-b-2"
                                        href="{{ route('products.detail', $item['id']) }}">
                                        XEM CHI TIẾT
                                    </a>

                                    <a class="w-r__link btn--e-transparent-platinum-b-2 remove-wishlist"
                                        data-product-id="{{ $item['id'] }}">
                                        XÓA
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <!--====== End - Wishlist Product ======-->
                    </div>

                    <div class="col-lg-12">
                        <div class="route-box">
                            <div class="route-box__g">
                                <a class="route-box__link" href="{{ route('shop.side_v2') }}">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span>TIẾP TỤC MUA SẮM</span>
                                </a>
                            </div>

                            <button type="button" class="route-box__link clear-wishlist"
                                style="background:none;border:none">
                                <i class="fas fa-trash"></i>
                                <span>XÓA TOÀN BỘ DANH SÁCH YÊU THÍCH</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->
</div>

<div class="modal fade" id="add-to-cart">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-radius modal-shadow">

            <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="success u-s-m-b-30">
                            <div class="success__text-wrap">
                                <i class="fas fa-check"></i>
                                <span>Sản phẩm đã được thêm thành công!</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="s-option">
                            <span class="s-option__text">Có 1 sản phẩm trong giỏ hàng</span>
                            <div class="s-option__link-box">
                                <a class="s-option__link btn--e-white-brand-shadow" data-dismiss="modal">
                                    TIẾP TỤC MUA SẮM
                                </a>
                                <a class="s-option__link btn--e-white-brand-shadow" href="{{ route('cart') }}">
                                    XEM GIỎ HÀNG
                                </a>
                                <a class="s-option__link btn--e-brand-shadow" href="{{ route('checkout') }}">
                                    TIẾN HÀNH THANH TOÁN
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
{{-- 4. Kết thúc phần nội dung --}}
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {

        function getCookie(name) {
            const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
            return match ? match[2] : null;
        }

        const token = getCookie("auth_token");

        document.querySelectorAll(".remove-wishlist").forEach(btn => {
            btn.addEventListener("click", async function(e) {
                e.preventDefault(); // 

                if (!token) {
                    window.location.href = "/signin";
                    return;
                }

                const productId = this.dataset.productId;

                try {
                    const res = await fetch(`http://127.0.0.1:8005/api/wishlist/${productId}`, {
                        method: "DELETE",
                        headers: {
                            "Authorization": "Bearer " + token
                        }
                    });

                    if (!res.ok) {
                        alert("Không thể xoá sản phẩm khỏi wishlist!");
                        return;
                    }

                    // Xoá UI ngay, không reload
                    const item = this.closest(".w-r");
                    if (item) item.remove();

                    // Nếu hết sản phẩm → reload để hiện "Wishlist is empty"
                    if (document.querySelectorAll(".w-r").length === 0) {
                        location.reload();
                    }

                } catch (err) {
                    console.error("Remove wishlist error:", err);
                    alert("Có lỗi xảy ra, thử lại sau!");
                }
            });
        });

    });
</script>
@endpush

<script>
    document.addEventListener("DOMContentLoaded", function() {

        function getCookie(name) {
            const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
            return match ? match[2] : null;
        }

        const token = getCookie("auth_token");
        const btn = document.querySelector(".clear-wishlist");

        if (!btn) return;

        btn.addEventListener("click", async function(e) {
            e.preventDefault();

            if (!token) {
                window.location.href = "/signin";
                return;
            }

            if (!confirm("Bạn có chắc muốn xoá toàn bộ wishlist?")) return;

            const res = await fetch("http://127.0.0.1:8005/api/wishlist", {
                method: "DELETE",
                headers: {
                    "Authorization": "Bearer " + token
                }
            });

            if (!res.ok) {
                console.error("Clear wishlist failed:", res.status);
                alert("Không thể xoá wishlist!");
                return;
            }

            location.reload();
        });
    });
</script>