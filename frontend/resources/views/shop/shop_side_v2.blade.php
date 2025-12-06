{{-- 1. Kế thừa file layout chính --}}
@extends('layouts.app')

{{-- 2. Đặt tiêu đề riêng cho trang này (sẽ thay thế @yield('title')) --}}
{{-- Trong thực tế, bạn sẽ dùng biến động: @section('title', $post->title) --}}
@section('title', 'Ludus - Chi Tiết Bài Viết')


{{-- 3. Bắt đầu phần nội dung (sẽ thay thế @yield('content')) --}}
@section('content')
<!--====== App Content ======-->
<div class="app-content">

    <!--====== Section 1 ======-->
    <div class="u-s-p-y-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="shop-w-master">
                        <h1 class="shop-w-master__heading u-s-m-b-30"><i class="fas fa-filter u-s-m-r-8"></i>

                            <span>FILTERS</span>
                        </h1>
                        <div class="shop-w-master__sidebar">
                            <div class="u-s-m-b-30">
                                <div class="shop-w shop-w--style">
                                    <div class="shop-w__intro-wrap">
                                        <h1 class="shop-w__h">CATEGORY</h1>

                                        <span class="fas fa-minus shop-w__toggle" data-target="#s-category"
                                            data-toggle="collapse"></span>
                                    </div>
                                    <div class="shop-w__wrap collapse show" id="s-category">
                                        <ul class="shop-w__category-list gl-scroll">
                                            @foreach ($categories as $cate)
                                            <li>
                                                <a
                                                    href="{{ request()->fullUrlWithQuery(['category' => $cate['id'], 'page' => 1]) }}">
                                                    {{ $cate['name'] }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="u-s-m-b-30">
                                <div class="shop-w shop-w--style">
                                    <div class="shop-w__intro-wrap">
                                        <h1 class="shop-w__h">PRICE</h1>

                                        <span class="fas fa-minus shop-w__toggle" data-target="#s-price"
                                            data-toggle="collapse"></span>
                                    </div>
                                    <div class="shop-w__wrap collapse show" id="s-price">
                                        <form class="shop-w__form-p" method="GET" action="">
                                            <div class="shop-w__form-p-wrap">
                                                {{-- GIỮ LẠI CATEGORY NẾU CÓ --}}
                                                @if (request('category'))
                                                <input type="hidden" name="category" value="{{ request('category') }}">
                                                @endif

                                                {{-- GIỮ LẠI LIMIT NẾU CÓ --}}
                                                @if (request('limit'))
                                                <input type="hidden" name="limit" value="{{ request('limit') }}">
                                                @endif

                                                {{-- GIỮ LẠI PAGE (reset về 1) --}}
                                                <input type="hidden" name="page" value="1">
                                                <div>
                                                    <input class="input-text input-text--primary-style" type="text"
                                                        name="price_min" id="price-min"
                                                        value="{{ request('price_min') }}" placeholder="Min">
                                                </div>

                                                <div>
                                                    <input class="input-text input-text--primary-style" type="text"
                                                        name="price_max" id="price-max"
                                                        value="{{ request('price_max') }}" placeholder="Max">
                                                </div>

                                                <div>
                                                    <button
                                                        class="btn btn--icon fas fa-angle-right btn--e-transparent-platinum-b-2"
                                                        type="submit"></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="shop-p">
                        <div class="shop-p__toolbar u-s-m-b-30">
                            <div class="shop-p__tool-style">
                                <div class="tool-style__group u-s-m-b-8">

                                    <span class="js-shop-grid-target is-active">Grid</span>

                                    <span class="js-shop-list-target">List</span>
                                </div>
                                <form>
                                    <div class="tool-style__form-wrap">
                                        <select class="select-box select-box--transparent-b-2"
                                            data-base-url="{{ request()->url() }}?{{ http_build_query(request()->except(['limit'])) }}"
                                            onchange="location.href = this.dataset.baseUrl + '&limit=' + this.value;">
                                            <option value="8" {{ request('limit') == 8 ? 'selected' : '' }}>Show:
                                                8</option>
                                            <option value="12" {{ request('limit') == 12 ? 'selected' : '' }}>Show:
                                                12</option>
                                            <option value="16" {{ request('limit') == 16 ? 'selected' : '' }}>Show:
                                                16</option>
                                            <option value="28" {{ request('limit') == 28 ? 'selected' : '' }}>Show:
                                                28</option>

                                        </select>
                                        <!-- {{-- <div class="u-s-m-b-8"><select class="select-box select-box--transparent-b-2">
                                                    <option selected>Sort By: Newest Items</option>
                                                    <option>Sort By: Latest Items</option>
                                                    <option>Sort By: Best Selling</option>
                                                    <option>Sort By: Best Rating</option>
                                                    <option>Sort By: Lowest Price</option>
                                                    <option>Sort By: Highest Price</option>
                                                </select></div> --}} -->
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="shop-p__collection">
                            <div class="row is-grid-active">
                                @foreach ($products['data'] as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product-m">
                                        <div class="product-m__thumb">

                                            <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                                href="{{ route('products.detail', $p['id']) }}">
                                                <img class="aspect__img" src="{{ $p['primary_image'] }}"
                                                    alt="{{ $p['name'] }}">
                                            </a>
                                            <div class="product-m__quick-look">

                                                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look"
                                                    data-tooltip="tooltip" data-placement="top" title="Quick Look"></a>
                                            </div>
                                            <div class="product-m__add-cart">
                                                <a class="btn--e-brand add-to-cart-btn" data-product-id="{{ $p['id'] }}"
                                                    data-product-name="{{ $p['name'] }}"
                                                    data-product-price="{{ $p['price'] }}">
                                                    Thêm Sản Phẩm
                                                </a>
                                            </div>

                                        </div>
                                        <div class="product-m__content">
                                            <div class="product-m__category">
                                                <a href="#">
                                                    {{ $categories[$p['category_id'] - 1]['name'] ?? 'Category' }}
                                                </a>
                                            </div>
                                            <div class="product-m__name">
                                                <a href="{{ route('products.detail', $p['id']) }}">
                                                    {{ \Illuminate\Support\Str::limit($p['name'], 30, '...') }}
                                                </a>
                                            </div>
                                            <div class="product-m__rating gl-rating-style">
                                                {!! \App\Helpers\RatingHelper::render($p['avg_rating']) !!}
                                                <span class="product-m__review">({{ $p['total_reviews'] }})</span>
                                            </div>

                                            <div class="product-m__price">
                                                {{ number_format($p['price']) }}đ
                                            </div>
                                            <div class="product-m__hover">
                                                <div class="product-m__preview-description">

                                                    <span>{{ $p['description'] ?? '' }}</span>
                                                </div>
                                                <div class="product-m__wishlist">

                                                    <a class="far fa-heart" href="#" data-tooltip="tooltip"
                                                        data-placement="top" title="Add to Wishlist"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="u-s-p-y-60">
                            <ul class="shop-p__pagination">

                                {{-- Nút Prev --}}
                                @if ($products['current_page'] > 1)
                                <li>
                                    <a class="fas fa-angle-left"
                                        href="{{ request()->fullUrlWithQuery(['page' => $products['current_page'] - 1]) }}">
                                    </a>
                                </li>
                                @endif

                                {{-- Các trang --}}
                                @for ($i = 1; $i <= $products['last_page']; $i++) <li
                                    class="{{ $i == $products['current_page'] ? 'is-active' : '' }}">
                                    <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">
                                        {{ $i }}
                                    </a>
                                    </li>
                                    @endfor

                                    {{-- Nút Next --}}
                                    @if ($products['current_page'] < $products['last_page']) <li>
                                        <a class="fas fa-angle-right"
                                            href="{{ request()->fullUrlWithQuery(['page' => $products['current_page'] + 1]) }}">
                                        </a>
                                        </li>
                                        @endif

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->
</div>
<!--====== End - App Content ======-->
<!--====== Quick Look Modal ======-->
<div class="modal fade" id="quick-look">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal--shadow">

            <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">

                        <!--====== Product Breadcrumb ======-->
                        <div class="pd-breadcrumb u-s-m-b-30">
                            <ul class="pd-breadcrumb__list">
                                <li class="has-separator">

                                    <a href="index.hml">Home</a>
                                </li>
                                <li class="has-separator">

                                    <a href="{{ route('shop.side_v2') }}">Electronics</a>
                                </li>
                                <li class="has-separator">

                                    <a href="{{ route('shop.side_v2') }}">DSLR Cameras</a>
                                </li>
                                <li class="is-marked">

                                    <a href="{{ route('shop.side_v2') }}">Nikon Cameras</a>
                                </li>
                            </ul>
                        </div>
                        <!--====== End - Product Breadcrumb ======-->


                        <!--====== Product Detail ======-->
                        <div class="pd u-s-m-b-30">
                            <div class="pd-wrap">
                                <div id="js-product-detail-modal">
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-1.jpg" alt="">
                                    </div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-2.jpg" alt="">
                                    </div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-3.jpg" alt="">
                                    </div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-4.jpg" alt="">
                                    </div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-5.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="u-s-m-t-15">
                                <div id="js-product-detail-modal-thumbnail">
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-1.jpg" alt="">
                                    </div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-2.jpg" alt="">
                                    </div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-3.jpg" alt="">
                                    </div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-4.jpg" alt="">
                                    </div>
                                    <div>

                                        <img class="u-img-fluid" src="images/product/product-d-5.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--====== End - Product Detail ======-->
                    </div>
                    <div class="col-lg-7">

                        <!--====== Product Right Side Details ======-->
                        <div class="pd-detail">
                            <div>

                                <span class="pd-detail__name">Nikon Camera 4k Lens Zoom Pro</span>
                            </div>
                            <div>
                                <div class="pd-detail__inline">

                                    <span class="pd-detail__price">$6.99</span>

                                    <span class="pd-detail__discount">(76% OFF)</span><del
                                        class="pd-detail__del">$28.97</del>
                                </div>
                            </div>
                            <div class="u-s-m-b-15">
                                <div class="pd-detail__rating gl-rating-style"><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star-half-alt"></i>

                                    <span class="pd-detail__review u-s-m-l-4">

                                        <a href="#">23 Reviews</a></span>
                                </div>
                            </div>
                            <div class="u-s-m-b-15">
                                <div class="pd-detail__inline">

                                    <span class="pd-detail__stock">200 in stock</span>

                                    <span class="pd-detail__left">Only 2 left</span>
                                </div>
                            </div>
                            <div class="u-s-m-b-15">

                                <span class="pd-detail__preview-desc">Lorem Ipsum is simply dummy text of the printing
                                    and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                    ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                                    to make a type specimen book.</span>
                            </div>
                            <div class="u-s-m-b-15">
                                <div class="pd-detail__inline">

                                    <span class="pd-detail__click-wrap"><i class="far fa-heart u-s-m-r-6"></i>

                                        <a href="{{ route('login') }}">Add to Wishlist</a>

                                        <span class="pd-detail__click-count">(222)</span></span>
                                </div>
                            </div>
                            <div class="u-s-m-b-15">
                                <div class="pd-detail__inline">

                                    <span class="pd-detail__click-wrap"><i class="far fa-envelope u-s-m-r-6"></i>

                                        <a href="{{ route('login') }}">Email me When the price drops</a>

                                        <span class="pd-detail__click-count">(20)</span></span>
                                </div>
                            </div>
                            <div class="u-s-m-b-15">
                                <ul class="pd-social-list">
                                    <li>

                                        <a class="s-fb--color-hover" href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>

                                        <a class="s-tw--color-hover" href="#"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>

                                        <a class="s-insta--color-hover" href="#"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li>

                                        <a class="s-wa--color-hover" href="#"><i class="fab fa-whatsapp"></i></a>
                                    </li>
                                    <li>

                                        <a class="s-gplus--color-hover" href="#"><i
                                                class="fab fa-google-plus-g"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="u-s-m-b-15">
                                <form class="pd-detail__form">
                                    <div class="pd-detail-inline-2">
                                        <div class="u-s-m-b-15">

                                            <!--====== Input Counter ======-->
                                            <div class="input-counter">

                                                <span class="input-counter__minus fas fa-minus"></span>

                                                <input class="input-counter__text input-counter--text-primary-style"
                                                    type="text" value="1" data-min="1" data-max="1000">

                                                <span class="input-counter__plus fas fa-plus"></span>
                                            </div>
                                            <!--====== End - Input Counter ======-->
                                        </div>
                                        <div class="u-s-m-b-15">

                                            <button class="btn btn--e-brand-b-2" type="submit">Add to Cart</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="u-s-m-b-15">

                                <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                                <ul class="pd-detail__policy-list">
                                    <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                        <span>Buyer Protection.</span>
                                    </li>
                                    <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                        <span>Full Refund if you don't receive your order.</span>
                                    </li>
                                    <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                        <span>Returns accepted if product not as described.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--====== End - Product Right Side Details ======-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== End - Quick Look Modal ======-->


<!--====== Add to Cart Modal ======-->
<div class="modal fade" id="add-to-cart">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-radius modal-shadow">

            <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="success u-s-m-b-30">
                            <div class="success__text-wrap"><i class="fas fa-check"></i>

                                <span>Item is added successfully!</span>
                            </div>
                            <div class="success__img-wrap">

                                <img class="u-img-fluid" src="images/product/electronic/product1.jpg" alt="">
                            </div>
                            <div class="success__info-wrap">

                                <span class="success__name">Beats Bomb Wireless Headphone</span>

                                <span class="success__quantity">Quantity: 1</span>

                                <span class="success__price">$170.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="s-option">

                            <span class="s-option__text">1 item (s) in your cart</span>
                            <div class="s-option__link-box">

                                <a class="s-option__link btn--e-white-brand-shadow" data-dismiss="modal">CONTINUE
                                    SHOPPING</a>

                                <a class="s-option__link btn--e-white-brand-shadow" href="{{ route('cart') }}">VIEW
                                    CART</a>

                                <a class="s-option__link btn--e-brand-shadow" href="{{ route('checkout') }}">PROCEED
                                    TO
                                    CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== End - Add to Cart Modal ======-->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // ============================
        //  HÀM LẤY JWT TỪ COOKIE
        // ============================
        function getCookie(name) {
            const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
            return match ? match[2] : null;
        }

        // Lấy user_id từ JWT (giống checkout)
        function getUserIdFromJWT() {
            const token = getCookie("auth_token");
            if (!token) return null;

            try {
                const payload = JSON.parse(atob(token.split(".")[1]));
                return payload.sub; // user_id
            } catch (err) {
                return null;
            }
        }

        const userId = getUserIdFromJWT();

        // ============================
        //  XỬ LÝ ADD TO CART
        // ============================
        document.querySelectorAll(".add-to-cart-btn").forEach(btn => {
            btn.addEventListener("click", async function(e) {
                e.preventDefault();

                if (!userId) {
                    alert("Bạn cần đăng nhập trước khi thêm vào giỏ hàng!");
                    window.location.href = "/signin";
                    return;
                }

                const productId = Number(this.dataset.productId);
                const productName = this.dataset.productName;
                const productPrice = Number(this.dataset.productPrice);

                const payload = {
                    user_id: userId,
                    product_id: productId,
                    product_name: productName,
                    price: productPrice,
                    quantity: 1
                };

                const res = await fetch("http://127.0.0.1:8002/api/cart/add", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (data.ok) {
                    // alert("Đã thêm vào giỏ hàng!");
                    location.reload();
                } else {
                    alert("Không thể thêm sản phẩm vào giỏ hàng!");
                    console.error(data);
                }
            });
        });

    });
</script>




@endsection
{{-- 4. Kết thúc phần nội dung --}}