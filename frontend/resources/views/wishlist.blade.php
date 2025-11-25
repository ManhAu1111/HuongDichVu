{{-- 1. Kế thừa file layout chính --}}
@extends('layouts.app')

{{-- 2. Đặt tiêu đề riêng cho trang này (sẽ thay thế @yield('title')) --}}
{{-- Trong thực tế, bạn sẽ dùng biến động: @section('title', $post->title) --}}
@section('title', 'Ludus - Chi Tiết Bài Viết')


{{-- 3. Bắt đầu phần nội dung (sẽ thay thế @yield('content')) --}}
@section('content')
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

                                    <a href="{{ route('shop.index') }}">Home</a>
                                </li>
                                <li class="is-marked">

                                    <a href="{{ route('wishlist') }}">Wishlist</a>
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
                                <h1 class="section__heading u-c-secondary">Wishlist</h1>
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

                            <!--====== Wishlist Product ======-->
                            <div class="w-r u-s-m-b-30">
                                <div class="w-r__container">
                                    <div class="w-r__wrap-1">
                                        <div class="w-r__img-wrap">

                                            <img class="u-img-fluid" src="images/product/electronic/product3.jpg" alt="">
                                        </div>
                                        <div class="w-r__info">

                                            <span class="w-r__name">

                                                <a href="{{ route('products.detail') }}">Yellow Wireless Headphone</a></span>

                                            <span class="w-r__category">

                                                <a href="{{ route('shop.side_v2') }}">Electronics</a></span>

                                            <span class="w-r__price">$125.00

                                                <span class="w-r__discount">$160.00</span></span>
                                        </div>
                                    </div>
                                    <div class="w-r__wrap-2">

                                        <a class="w-r__link btn--e-brand-b-2" data-modal="modal"
                                            data-modal-id="#add-to-cart">ADD TO CART</a>

                                        <a class="w-r__link btn--e-transparent-platinum-b-2"
                                            href="{{ route('products.detail') }}">VIEW</a>

                                        <a class="w-r__link btn--e-transparent-platinum-b-2" href="#">REMOVE</a>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Wishlist Product ======-->


                            <!--====== Wishlist Product ======-->
                            <div class="w-r u-s-m-b-30">
                                <div class="w-r__container">
                                    <div class="w-r__wrap-1">
                                        <div class="w-r__img-wrap">

                                            <img class="u-img-fluid" src="images/product/women/product8.jpg" alt="">
                                        </div>
                                        <div class="w-r__info">

                                            <span class="w-r__name">

                                                <a href="{{ route('products.detail') }}">New Dress D Nice Elegant</a></span>

                                            <span class="w-r__category">

                                                <a href="{{ route('shop.side_v2') }}">Women Clothing</a></span>

                                            <span class="w-r__price">$125.00

                                                <span class="w-r__discount">$160.00</span></span>
                                        </div>
                                    </div>
                                    <div class="w-r__wrap-2">

                                        <a class="w-r__link btn--e-brand-b-2" data-modal="modal"
                                            data-modal-id="#add-to-cart">ADD TO CART</a>

                                        <a class="w-r__link btn--e-transparent-platinum-b-2"
                                            href="{{ route('products.detail') }}">VIEW</a>

                                        <a class="w-r__link btn--e-transparent-platinum-b-2" href="#">REMOVE</a>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Wishlist Product ======-->


                            <!--====== Wishlist Product ======-->
                            <div class="w-r u-s-m-b-30">
                                <div class="w-r__container">
                                    <div class="w-r__wrap-1">
                                        <div class="w-r__img-wrap">

                                            <img class="u-img-fluid" src="images/product/men/product8.jpg" alt="">
                                        </div>
                                        <div class="w-r__info">

                                            <span class="w-r__name">

                                                <a href="{{ route('products.detail') }}">New Fashion D Nice Elegant</a></span>

                                            <span class="w-r__category">

                                                <a href="{{ route('shop.side_v2') }}">Men Clothing</a></span>

                                            <span class="w-r__price">$125.00

                                                <span class="w-r__discount">$160.00</span></span>
                                        </div>
                                    </div>
                                    <div class="w-r__wrap-2">

                                        <a class="w-r__link btn--e-brand-b-2" data-modal="modal"
                                            data-modal-id="#add-to-cart">ADD TO CART</a>

                                        <a class="w-r__link btn--e-transparent-platinum-b-2"
                                            href="{{ route('products.detail') }}">VIEW</a>

                                        <a class="w-r__link btn--e-transparent-platinum-b-2" href="#">REMOVE</a>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Wishlist Product ======-->
                        </div>
                        <div class="col-lg-12">
                            <div class="route-box">
                                <div class="route-box__g">

                                    <a class="route-box__link" href="{{ route('shop.side_v2') }}"><i
                                            class="fas fa-long-arrow-alt-left"></i>

                                        <span>CONTINUE SHOPPING</span></a>
                                </div>
                                <div class="route-box__g">

                                    <a class="route-box__link" href="{{ route('wishlist') }}"><i class="fas fa-trash"></i>

                                        <span>CLEAR WISHLIST</span></a>
                                </div>
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

                                    <a class="s-option__link btn--e-white-brand-shadow" href="{{ route('cart') }}">VIEW CART</a>

                                    <a class="s-option__link btn--e-brand-shadow" href="{{ route('checkout') }}">PROCEED TO
                                        CHECKOUT</a>
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
