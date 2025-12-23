{{-- 1. Kế thừa file layout chính --}}
@extends('layouts.app')

{{-- 2. Đặt tiêu đề riêng cho trang này (sẽ thay thế @yield('title')) --}}
{{-- Trong thực tế, bạn sẽ dùng biến động: @section('title', $post->title) --}}
@section('title', 'Ludus - Chi Tiết Bài Viết')


{{-- 3. Bắt đầu phần nội dung (sẽ thay thế @yield('content')) --}}
@section('content')
<div class="app-content">

    <!--====== Section 1 ======-->
    <div class="u-s-p-y-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bp bp--img u-s-m-b-30">
                        <div class="bp__wrap">
                            <div class="bp__thumbnail">

                                <!--====== Image Code ======-->

                                <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block"
                                    href="{{ route('blog.detail') }}">

                                    <img class="aspect__img" src="images/blog/post-1.jpg" alt=""></a>
                                <!--====== End - Image Code ======-->
                            </div>
                            <div class="bp__info-wrap">

                                <span class="bp__h1">

                                    <a href="{{ route('blog.detail') }}">Giướng lớn thoải mái, rộng rãi</a></span>

                                <span class="bp__h2">Bài đăng có kèm hình ảnh</span>
                                <div class="blog-t-w">

                                    <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                        href="{{ route('blog.SidebarNone') }}">Đơn giản</a>

                                    <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                        href="{{ route('blog.SidebarNone') }}">Rộng</a>

                                    <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                        href="{{ route('blog.SidebarNone') }}">Thoải mái</a>
                                </div>
                                <p class="bp__p">Giường ngủ thông minh với thiết kế sang trọng, rộng rãi giúp thoải mái,
                                    dễ chìm vào giấc ngủ</p>
                                <div class="gl-l-r">
                                    <div>

                                        <span class="bp__read-more">

                                            <a href="{{ route('blog.detail') }}">CHI TIẾT</a></span>
                                    </div>
                                    <ul class="bp__social-list">
                                        <li>

                                            <a class="s-fb--color" href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-tw--color" href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-insta--color" href="#"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-wa--color" href="#"><i class="fab fa-whatsapp"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-gplus--color" href="#"><i class="fab fa-google-plus-g"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bp u-s-m-b-30">
                        <div class="bp__wrap">
                            <div class="bp__thumbnail">

                                <!--====== Gallery Code ======-->
                                <div class="slider-fouc">
                                    <div class="owl-carousel post-gallery">
                                        <div>

                                            <a href="{{ route('blog.detail2') }}">

                                                <img class="u-img-fluid" src="images/blog/post-2.jpg" alt=""></a>
                                        </div>
                                        <div>

                                            <a href="{{ route('blog.detail2') }}">

                                                <img class="u-img-fluid" src="images/blog/post-3.jpg" alt=""></a>
                                        </div>
                                        <div>

                                            <a href="{{ route('blog.detail2') }}">

                                                <img class="u-img-fluid" src="images/blog/post-4.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <!--====== End - Gallery Code ======-->
                            </div>
                            <div class="bp__info-wrap">


                                <span class="bp__h1">

                                    <a href="{{ route('blog.detail2') }}">Chiếc giường với thiết kế bắt mắt mang phong
                                        cách sang trọng, quý phái</a></span>

                                <span class="bp__h2">Bài đăng kèm bộ sưu tập ảnh</span>
                                <div class="blog-t-w">

                                    <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                        href="{{ route('blog.SidebarNone') }}">Sáng tạo</a>

                                    <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                        href="{{ route('blog.SidebarNone') }}">Nghệ thuật</a>

                                    <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                        href="{{ route('blog.SidebarNone') }}">Thiết kế</a>
                                </div>
                                <p class="bp__p">Đồ trang trí nội thất trong nhà mang phong cách sang trọng, lịch sự
                                    nhưng không kém phần tối giản</p>
                                <div class="gl-l-r">
                                    <div>

                                        <span class="bp__read-more">

                                            <a href="{{ route('blog.detail2') }}">CHI TIẾT</a></span>
                                    </div>
                                    <ul class="bp__social-list">
                                        <li>

                                            <a class="s-fb--color" href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-tw--color" href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-insta--color" href="#"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-wa--color" href="#"><i class="fab fa-whatsapp"></i></a>
                                        </li>
                                        <li>

                                            <a class="s-gplus--color" href="#"><i class="fab fa-google-plus-g"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav class="post-center-wrap u-s-p-y-60">

                        <!--====== Pagination ======-->
                        <ul class="blog-pg">
                            <li class="blog-pg--active">

                                <a href="{{ route('blog.SidebarNone') }}">1</a>
                            </li>
                            <li>

                                <a href="{{ route('blog.SidebarNone') }}">2</a>
                            </li>
                            <li>

                                <a href="{{ route('blog.SidebarNone') }}">3</a>
                            </li>
                            <li>

                                <a href="{{ route('blog.SidebarNone') }}">4</a>
                            </li>
                            <li>

                                <a class="fas fa-angle-right" href="{{ route('blog.SidebarNone') }}"></a>
                            </li>
                        </ul>
                        <!--====== End - Pagination ======-->
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->
</div>
@endsection
{{-- 4. Kết thúc phần nội dung --}}