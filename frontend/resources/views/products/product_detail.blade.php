@extends('layouts.app')

{{-- 2. Đặt tiêu đề riêng cho trang này (sẽ thay thế @yield('title')) --}}
{{-- Trong thực tế, bạn sẽ dùng biến động: @section('title', $post->title) --}}
@section('title', 'Ludus - Chi Tiết Bài Viết')

{{-- 3. Bắt đầu phần nội dung (sẽ thay thế @yield('content')) --}}
@section('content')

<!--====== App Content ======-->
<div class="app-content">

    <!--====== Section 1 ======-->
    <div class="u-s-p-t-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">

                    <!--====== Product Breadcrumb ======-->
                    <div class="pd-breadcrumb u-s-m-b-30">
                        <ul class="pd-breadcrumb__list">
                            <li class="has-separator">
                                <a href="{{ route('shop.index') }}">Trang Chủ</a>
                            </li>

                            <li class="has-separator">
                                <a href="{{ route('shop.side_v2', ['category' => $category['id']]) }}">
                                    {{ $category['name'] }}
                                </a>
                            </li>

                            <li class="is-marked">
                                <a href="{{ route('products.detail', $product['id']) }}">
                                    {{ $product['name'] }}
                                </a>
                            </li>
                        </ul>

                    </div>
                    <!--====== End - Product Breadcrumb ======-->


                    <!--====== Product Detail Zoom ======-->
                    <div class="pd u-s-m-b-30">
                        <div class="slider-fouc pd-wrap">
                            <div id="pd-o-initiate">
                                <div class="pd-o-img-wrap no-zoom">
                                    <model-viewer src="{{ asset(str_replace('\\', '/', $product['model_url'])) }}"
                                        alt="Model 3D {{ $product['name'] }}" auto-rotate camera-controls
                                        shadow-intensity="1" exposure="1.0"
                                        style="width:100%; height:400px; background:#f1f1f1; border-radius:8px;">
                                    </model-viewer>
                                </div>

                                @foreach ($images as $img)
                                <div class="pd-o-img-wrap"
                                    data-src="{{ asset(str_replace('\\', '/', $img['image_url'])) }}"
                                    style="width:100%; height:400px; overflow:hidden; border-radius:8px; background:#f8f8f8;">

                                    <img class="product-detail-img"
                                        src="{{ asset(str_replace('\\', '/', $img['image_url'])) }}"
                                        alt="{{ $product['name'] }}">
                                </div>
                                @endforeach
                            </div>
                            <span class="pd-text">Click for larger zoom</span>
                        </div>
                        <div class="u-s-m-t-15">
                            <div class="slider-fouc">
                                <div id="pd-o-thumbnail">
                                    <div
                                        style="width:80px; height:80px; border-radius:6px; overflow:hidden; position:relative;">
                                        <!-- CHẶN MỌI TƯƠNG TÁC -->
                                        <div style="
                                                position:absolute;
                                                top:0;
                                                left:0;
                                                width:100%;
                                                height:100%;
                                                z-index:10;
                                                cursor:default;
                                            ">
                                        </div>

                                        <model-viewer src="{{ asset(str_replace('\\', '/', $product['model_url'])) }}"
                                            interaction-prompt="none" disable-zoom disable-pan disable-tap
                                            camera-controls style="width:100%; height:100%; background:#f1f1f1;">
                                        </model-viewer>
                                    </div>

                                    @foreach ($images as $img)
                                    @php
                                    $imgUrl = asset(str_replace('\\', '/', $img['image_url']));
                                    @endphp

                                    <div>
                                        <img class="u-img-fluid" src="{{ $imgUrl }}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--====== End - Product Detail Zoom ======-->
                </div>
                <div class="col-lg-7">

                    <!--====== Product Right Side Details ======-->
                    <div class="pd-detail">
                        <div>

                            <span class="pd-detail__name">{{ $product['name'] }}</span>
                        </div>
                        <div>
                            <div class="pd-detail__inline">
                                {{-- xử lý lại giá trị hiển thị --}}
                                <span class="pd-detail__price">{{ number_format($product['price'], 0, ',', '.') }}
                                    ₫</span>
                            </div>
                        </div>
                        <div class="u-s-m-b-15">
                            <div class="pd-detail__rating gl-rating-style">

                                {!! \App\Helpers\RatingHelper::render($product['avg_rating']) !!}

                                @auth
                                <input type="hidden" id="user-id" value="{{ auth()->id() }}">
                                <input type="hidden" id="user-name" value="{{ auth()->user()->name }}">
                                @endauth

                                <span class="pd-detail__review u-s-m-l-4">
                                    <a data-click-scroll="#view-review">
                                        {{ $product['total_reviews'] }} Reviews
                                    </a>
                                </span>

                            </div>
                        </div>

                        <div class="u-s-m-b-15">
                            <div class="pd-detail__inline">
                                <span class="pd-detail__left"> còn {{ $product['quantity'] }} sản phẩm</span>
                            </div>
                        </div>
                        <div class="u-s-m-b-15">

                            <span class="pd-detail__preview-desc">{{ $product['description'] }}</span>
                        </div>
                        {{-- <div class="u-s-m-b-15">
                                <div class="pd-detail__inline">

                                    <span class="pd-detail__click-wrap"><i class="far fa-heart u-s-m-r-6"></i>

                                        <a href="{{ route('login') }}">Add to Wishlist</a>
                    </div>
                </div> --}}
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

                            <a class="s-gplus--color-hover" href="#"><i class="fab fa-google-plus-g"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="u-s-m-b-15">
                    <div class="pd-detail-inline-2">
                        <div class="u-s-m-b-15">

                            <div class="input-counter">
                                <span class="input-counter__minus fas fa-minus"></span>

                                <input id="detail-qty" class="input-counter__text input-counter--text-primary-style"
                                    type="text" value="1" data-min="1" data-max="{{ $product['quantity'] }}">

                                <span class="input-counter__plus fas fa-plus"></span>
                            </div>

                        </div>

                        <div class="u-s-m-b-15">
                            <button class="btn btn--e-brand-b-2" type="button" id="add-detail-btn"
                                data-product-id="{{ $product['id'] }}" data-product-name="{{ $product['name'] }}"
                                data-product-price="{{ $product['price'] }}">
                                Thêm Sản Phẩm
                            </button>
                        </div>
                    </div>
                </div>

                <div class="u-s-m-b-15">

                    <span class="pd-detail__label u-s-m-b-8">Chính sách sản phẩm:</span>
                    <ul class="pd-detail__policy-list">
                        <li>
                            <i class="fas fa-check-circle u-s-m-r-8"></i>
                            <span>Bảo vệ quyền lợi người mua.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle u-s-m-r-8"></i>
                            <span>Hoàn tiền đầy đủ nếu không nhận được đơn hàng.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle u-s-m-r-8"></i>
                            <span>Chấp nhận đổi trả nếu sản phẩm không đúng với mô tả.</span>
                        </li>
                    </ul>
                </div>

            </div>
            <!--====== End - Product Right Side Details ======-->
        </div>
    </div>
</div>
</div>

<!--====== Product Detail Tab ======-->
<div class="u-s-p-y-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pd-tab">
                    <div class="u-s-m-b-30">
                        <ul class="nav pd-tab__list">
                            <li class="nav-item">

                                <a class="nav-link active" data-toggle="tab" href="#pd-desc">MÔ TẢ</a>
                            </li>
                            <!-- <li class="nav-item">

                                <a class="nav-link" data-toggle="tab" href="#pd-tag">TAGS</a>
                            </li> -->
                            <li class="nav-item">

                                <a class="nav-link" id="view-review" data-toggle="tab" href="#pd-rev">ĐÁNH GIÁ

                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">

                        <!--====== Tab 1 ======-->
                        <div class="tab-pane fade show active" id="pd-desc">
                            <div class="pd-tab__desc">
                                <div class="u-s-m-b-15">
                                    <span class="pd-detail__preview-desc">{{ $product['description'] }}</span>
                                </div>
                                <div class="u-s-m-b-30"><iframe src="https://www.youtube.com/embed/qKqSBm07KZk"
                                        allowfullscreen></iframe></div>
                                <div class="u-s-m-b-30">
                                    <ul>
                                        <li><i class="fas fa-check u-s-m-r-8"></i>

                                            <span>Bảo vệ quyền lợi người mua.</span>
                                        </li>
                                        <li><i class="fas fa-check u-s-m-r-8"></i>

                                            <span>Hoàn tiền đầy đủ nếu không nhận được đơn hàng.</span>
                                        </li>
                                        <li><i class="fas fa-check u-s-m-r-8"></i>

                                            <span>Chấp nhận đổi trả nếu sản phẩm không đúng với mô tả.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--====== End - Tab 1 ======-->


                        <!--====== Tab 2 ======-->
                        <div class="tab-pane" id="pd-tag">
                            <div class="pd-tab__tag">
                                <h2 class="u-s-m-b-15">ADD YOUR TAGS</h2>
                                <div class="u-s-m-b-15">
                                    <form>

                                        <input class="input-text input-text--primary-style" type="text">

                                        <button class="btn btn--e-brand-b-2" type="submit">ADD TAGS</button>
                                    </form>
                                </div>

                                <span class="gl-text">Use spaces to separate tags. Use single quotes (') for
                                    phrases.</span>
                            </div>
                        </div>
                        <!--====== End - Tab 2 ======-->


                        <!--====== Tab 3 ======-->
                        <div class="tab-pane" id="pd-rev">
                            <div class="pd-tab__rev">
                                <div class="u-s-m-b-30">
                                    <div class="pd-tab__rev-score">
                                        <div class="u-s-m-b-8">
                                            <!-- Tổng review + rating -->
                                            <h2 id="review-summary">Đang tải đánh giá...</h2>
                                        </div>

                                        <!-- Sao trung bình -->
                                        <div id="review-average-stars" class="gl-rating-style-2 u-s-m-b-8"></div>

                                        <div class="u-s-m-b-8">
                                            <h4>Chúng tôi rất muốn nghe ý kiến của bạn!</h4>
                                        </div>

                                        <span class="gl-text">Hãy chia sẻ cảm nhận của bạn về sản phẩm này</span>
                                    </div>
                                </div>

                                <div class="u-s-m-b-30">
                                    <form class="pd-tab__rev-f1">
                                        <div class="rev-f1__group">
                                            <div class="u-s-m-b-15">
                                                <!-- Tên sản phẩm -->
                                                <h2 id="review-product-title">Đánh giá</h2>
                                            </div>

                                            <div class="u-s-m-b-15">
                                                <label for="sort-review"></label>
                                                <select class="select-box select-box--primary-style" id="sort-review">
                                                    <option value="best" selected>Sắp xếp: Đánh giá cao nhất</option>
                                                    <option value="newest">Sắp xếp: Mới nhất</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- List review -->
                                        <div class="rev-f1__review">
                                            <!-- JS sẽ render -->
                                        </div>
                                    </form>
                                </div>

                                <div class="u-s-m-b-30">
                                    <form class="pd-tab__rev-f2">
                                        <input type="hidden" id="product-id" value="{{ $product['id'] }}">
                                        <h2 class="u-s-m-b-15">Thêm đánh giá</h2>

                                        <span class="gl-text u-s-m-b-15">Email của bạn sẽ không bị công khai.
                                            Các trường bắt buộc được đánh dấu *</span>
                                        <div class="u-s-m-b-30">
                                            <div class="rev-f2__table-wrap gl-scroll">
                                                <table class="rev-f2__table">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <div class="gl-rating-style-2"><i
                                                                        class="fas fa-star"></i>

                                                                    <span>(1)</span>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="gl-rating-style-2"><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star-half-alt"></i>

                                                                    <span>(1.5)</span>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="gl-rating-style-2"><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i>

                                                                    <span>(2)</span>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="gl-rating-style-2"><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star-half-alt"></i>

                                                                    <span>(2.5)</span>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="gl-rating-style-2"><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i>

                                                                    <span>(3)</span>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="gl-rating-style-2"><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star-half-alt"></i>

                                                                    <span>(3.5)</span>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="gl-rating-style-2"><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i>

                                                                    <span>(4)</span>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="gl-rating-style-2"><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star-half-alt"></i>

                                                                    <span>(4.5)</span>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="gl-rating-style-2"><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i><i
                                                                        class="fas fa-star"></i>

                                                                    <span>(5)</span>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="radio-box">
                                                                    <input type="radio" id="star-1" name="rating"
                                                                        value="1">
                                                                    <div
                                                                        class="radio-box__state radio-box__state--primary">
                                                                        <label class="radio-box__label"
                                                                            for="star-1"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="radio-box">
                                                                    <input type="radio" id="star-1.5" name="rating"
                                                                        value="1.5">
                                                                    <div
                                                                        class="radio-box__state radio-box__state--primary">
                                                                        <label class="radio-box__label"
                                                                            for="star-1.5"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="radio-box">
                                                                    <input type="radio" id="star-2" name="rating"
                                                                        value="2">
                                                                    <div
                                                                        class="radio-box__state radio-box__state--primary">
                                                                        <label class="radio-box__label"
                                                                            for="star-2"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="radio-box">
                                                                    <input type="radio" id="star-2.5" name="rating"
                                                                        value="2.5">
                                                                    <div
                                                                        class="radio-box__state radio-box__state--primary">
                                                                        <label class="radio-box__label"
                                                                            for="star-2.5"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="radio-box">
                                                                    <input type="radio" id="star-3" name="rating"
                                                                        value="3">
                                                                    <div
                                                                        class="radio-box__state radio-box__state--primary">
                                                                        <label class="radio-box__label"
                                                                            for="star-3"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="radio-box">
                                                                    <input type="radio" id="star-3.5" name="rating"
                                                                        value="3.5">
                                                                    <div
                                                                        class="radio-box__state radio-box__state--primary">
                                                                        <label class="radio-box__label"
                                                                            for="star-3.5"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="radio-box">
                                                                    <input type="radio" id="star-4" name="rating"
                                                                        value="4">
                                                                    <div
                                                                        class="radio-box__state radio-box__state--primary">
                                                                        <label class="radio-box__label"
                                                                            for="star-4"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="radio-box">
                                                                    <input type="radio" id="star-4.5" name="rating"
                                                                        value="4.5">
                                                                    <div
                                                                        class="radio-box__state radio-box__state--primary">
                                                                        <label class="radio-box__label"
                                                                            for="star-4.5"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="radio-box">
                                                                    <input type="radio" id="star-5" name="rating"
                                                                        value="5">
                                                                    <div
                                                                        class="radio-box__state radio-box__state--primary">
                                                                        <label class="radio-box__label"
                                                                            for="star-5"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="rev-f2__group">
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="reviewer-text">ĐÁNH GIÁ CỦA BẠN
                                                    *</label>
                                                <textarea class="text-area text-area--primary-style"
                                                    id="reviewer-text"></textarea>
                                            </div>
                                            <div>
                                                <p class="u-s-m-b-30">

                                                    <label class="gl-label" for="reviewer-name">TÊN *</label>

                                                    <input class="input-text input-text--primary-style" type="text"
                                                        id="reviewer-name">
                                                </p>
                                                <p class="u-s-m-b-30">

                                                    <label class="gl-label" for="reviewer-email">EMAIL *</label>

                                                    <input class="input-text input-text--primary-style" type="text"
                                                        id="reviewer-email">
                                                </p>
                                            </div>
                                        </div>
                                        <div>

                                            <button class="btn btn--e-brand-shadow" type="submit">GỬI ĐÁNH GIÁ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--====== End - Tab 3 ======-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== End - Product Detail Tab ======-->
<div class="u-s-p-b-90">

    <!--====== Section Intro ======-->
    <div class="section__intro u-s-m-b-46">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__text-wrap">
                        <h1 class="section__heading u-c-secondary u-s-m-b-12">KHÁCH HÀNG CŨNG XEM</h1>

                        <span class="section__span u-c-grey">SẢN PHẨM MÀ KHÁCH HÀNG ĐÃ XEM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Intro ======-->

    {{-- chưa hiển thị được slide sản phẩm --}}
    <!--====== Section Content ======-->
    <div class="section__content">
        <div class="container">
            <div class="slider-fouc">
                <div class="owl-carousel product-slider" data-item="4">
                    @foreach ($latest as $p)
                    <div class="u-s-m-b-30">
                        <div class="product-o product-o--hover-on">
                            <div class="product-o__wrap">

                                <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                    href="{{ route('products.detail', $p['id']) }}">
                                    <img class="aspect__img" src="{{ asset($p['primary_image']) }}"
                                        alt="{{ $p['name'] }}">
                                </a>

                                <div class="product-o__action-wrap">
                                    <ul class="product-o__action-list">

                                        <li><a href="{{ route('login') }}"><i class="fas fa-heart"></i></a>
                                        </li>
                                        <li><a href="{{ route('login') }}"><i class="fas fa-envelope"></i></a></li>
                                    </ul>
                                </div>

                            </div>

                            <span class="product-o__category">
                                <a href="#">{{ $categories[$p['category_id']]['name'] ?? 'Danh mục' }}</a>
                            </span>

                            <span class="product-o__name">
                                <a href="{{ route('products.detail', $p['id']) }}">
                                    {{ \Illuminate\Support\Str::limit($p['name'], 30, '...') }}</a>
                            </span>

                            <div class="product-o__rating gl-rating-style">
                                {!! \App\Helpers\RatingHelper::render($p['avg_rating']) !!}
                                <span class="product-o__review">({{ $p['total_reviews'] }})</span>
                            </div>

                            <span class="product-o__price">{{ number_format($p['price']) }}đ</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
</div>
<!--====== End - Section 1 ======-->
</div>
<!--====== End - App Content ======-->

<!--====== Modal Section ======-->


<!--====== Quick Look Modal ======-->
<div class="modal fade" id="quick-look">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal--shadow">

            <button class="btn dismiss-button fas fa-times" type="button" data-bs-dismiss="modal"></button>
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

            <button class="btn dismiss-button fas fa-times" type="button" data-bs-dismiss="modal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="success u-s-m-b-30">
                            <div class="success__text-wrap"><i class="fas fa-check"></i>

                                <span>Item is added successfully!</span>
                            </div>
                            <div class="success__img-wrap">


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
<!--====== End - Modal Section ======-->

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const USER_ID = window.APP_USER_ID;
        if (!USER_ID) return;

        const API_CART = "http://127.0.0.1:8002/api/cart/add";

        const btn = document.getElementById("add-detail-btn");
        const qtyInput = document.getElementById("detail-qty");

        if (!btn || !qtyInput) return;

        btn.addEventListener("click", async function() {

            const qty = Number(qtyInput.value);
            const productId = Number(btn.dataset.productId);
            const productName = btn.dataset.productName;
            const productPrice = Number(btn.dataset.productPrice);

            const payload = {
                user_id: USER_ID,
                product_id: productId,
                product_name: productName,
                price: productPrice,
                quantity: qty
            };

            const res = await fetch(API_CART, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer " + localStorage.getItem("access_token")
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (data.ok) {

                // Gọi hàm loadMiniCart() của header
                if (typeof window.loadMiniCart === "function") {
                    window.loadMiniCart();
                }

                // alert("Đã thêm sản phẩm vào giỏ hàng!");

                // RELOAD trang để cập nhật cart page nếu cần
                location.reload();
            } else {
                alert("Không thể thêm sản phẩm!");
            }
        });

    });
</script>
<script>
    (function() {
        const API_REVIEW = 'http://127.0.0.1:8006';

        const productId = document.getElementById('product-id')?.value;
        const reviewForm = document.querySelector('.pd-tab__rev-f2');
        const reviewList = document.querySelector('.rev-f1__review');
        const sortSelect = document.getElementById('sort-review');

        const summaryEl = document.getElementById('review-summary');
        const starsEl = document.getElementById('review-average-stars');
        const titleEl = document.getElementById('review-product-title');

        if (!productId || !reviewForm || !reviewList || !summaryEl || !starsEl || !titleEl) return;

        /* ========= UTIL ========= */
        function renderStars(rating) {
            let html = '';
            const full = Math.floor(rating);
            const half = rating % 1 !== 0;

            for (let i = 0; i < full; i++) html += '<i class="fas fa-star"></i>';
            if (half) html += '<i class="fas fa-star-half-alt"></i>';
            for (let i = full + (half ? 1 : 0); i < 5; i++) {
                html += '<i class="far fa-star"></i>';
            }
            return html;
        }

        function updateHeader(data) {
            summaryEl.innerText = `${data.total} Đánh giá - ${data.average_rating} (Sao)`;
            starsEl.innerHTML = renderStars(data.average_rating);

            const productNameEl = document.querySelector('.pd-detail__name');
            if (productNameEl) {
                titleEl.innerText = `Reviews for ${productNameEl.innerText.trim()}`;
            }
        }

        function disableReviewForm(message) {
            reviewForm.querySelectorAll('input, textarea, button').forEach(el => {
                el.disabled = true;
            });

            reviewForm.insertAdjacentHTML(
                'afterbegin',
                `<p class="gl-text u-s-m-b-15">${message}</p>`
            );
        }

        /* ========= LOAD REVIEWS ========= */
        async function loadReviews(sort = 'best') {
            const res = await fetch(`${API_REVIEW}/reviews/${productId}?sort=${sort}`);
            if (!res.ok) return;

            const data = await res.json();
            updateHeader(data);

            reviewList.innerHTML = '';
            data.reviews.forEach(r => {
                reviewList.insertAdjacentHTML('beforeend', `
                <div class="review-o u-s-m-b-15">
                    <div class="review-o__info u-s-m-b-8">
                        <span class="review-o__name">${r.user_name}</span>
                        <span class="review-o__date">${r.created_at}</span>
                    </div>
                    <div class="review-o__rating gl-rating-style u-s-m-b-8">
                        ${renderStars(r.rating)}
                        <span>(${r.rating})</span>
                    </div>
                    <p class="review-o__text">${r.comment}</p>
                </div>
            `);
            });
        }

        /* ========= CHECK REVIEWED ========= */
        async function checkReviewed() {
            const res = await fetch(`${API_REVIEW}/reviews/check/${productId}`, {
                credentials: 'include'
            });

            if (!res.ok) return;

            const data = await res.json();
            if (data.reviewed) {
                disableReviewForm('Bạn đã đánh giá sản phẩm này.');
            }
        }

        /* ========= SUBMIT ========= */
        reviewForm.addEventListener('submit', async e => {
            e.preventDefault();

            const rating = document.querySelector('input[name="rating"]:checked')?.value;
            const comment = document.getElementById('reviewer-text')?.value.trim();

            if (!rating || !comment) {
                alert('Vui lòng nhập đầy đủ đánh giá');
                return;
            }

            const res = await fetch(`${API_REVIEW}/reviews`, {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    rating,
                    comment
                })
            });

            const data = await res.json();
            if (!res.ok) {
                alert(data.message || 'Submit failed');
                return;
            }

            await loadReviews(sortSelect?.value || 'best');
            disableReviewForm('Cảm ơn bạn đã đánh giá sản phẩm này ❤️');
        });

        /* ========= SORT ========= */
        sortSelect?.addEventListener('change', e => {
            loadReviews(e.target.value);
        });

        /* ========= INIT ========= */
        loadReviews();
        checkReviewed();
    })();
</script>





@endsection
{{-- 4. Kết thúc phần nội dung --}}