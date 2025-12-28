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

                                <a href="{{ route('shop.index') }}">Trang chủ</a>
                            </li>
                            <li class="is-marked">

                                <a href="{{ route('about') }}">Giới thiệu </a>
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

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about">
                            <div class="about__container">
                                <div class="about__info">
                                    <h2 class="about__h2">Chào mừng đến với LUDUS!</h2>
                                    <div class="about__p-wrap">
                                        <p class="about__p">Chào mừng bạn đến với LUDUS Store – nơi mang đến những giải
                                            pháp nội thất tinh tế cho không gian sống hiện đại. Chúng tôi chuyên cung
                                            cấp các sản phẩm nội thất được thiết kế chỉn chu, chú trọng vào chất lượng,
                                            công năng và tính thẩm mỹ. Với mong muốn tạo nên những không gian sống tiện
                                            nghi và ấm cúng, Reshop Store luôn không ngừng cải tiến dịch vụ, lựa chọn kỹ
                                            lưỡng từng sản phẩm để đáp ứng tốt nhất nhu cầu của khách hàng.</p>
                                    </div>
                                    <a class="about__link btn--e-secondary" href="{{ route('shop.side_v2') }}"
                                        target="_blank">Mua Sắm Ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->
    <!--====== Section 3 ======-->
    <div class="u-s-p-b-60">
        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">Danh Sách Thành Viên</h1>
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
                    <div class="col u-s-m-b-30" style="flex: 0 0 20%; max-width: 20%;">

                        <div class="team-member u-h-100">
                            <div class="team-member__wrap">
                                <div class="aspect aspect--bg-grey-fb aspect--square">

                                    <img class="aspect__img team-member__img" src="images/about/nam.jpg" alt="">
                                </div>

                            </div>
                            <div class="team-member__info">

                                <span class="team-member__name">Trương Thành Nam</span>

                                <span class="team-member__job-title">Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="col u-s-m-b-30" style="flex: 0 0 20%; max-width: 20%;">

                        <div class="team-member u-h-100">
                            <div class="team-member__wrap">
                                <div class="aspect aspect--bg-grey-fb aspect--square">

                                    <img class="aspect__img team-member__img" src="images/about/dat.jpg" alt="">
                                </div>

                            </div>
                            <div class="team-member__info">

                                <span class="team-member__name">Bùi Kim Đạt</span>

                                <span class="team-member__job-title">UI, Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col u-s-m-b-30" style="flex: 0 0 20%; max-width: 20%;">

                        <div class="team-member u-h-100">
                            <div class="team-member__wrap">
                                <div class="aspect aspect--bg-grey-fb aspect--square">

                                    <img class="aspect__img team-member__img" src="images/about/khai.jpg" alt="">
                                </div>
                            </div>
                            <div class="team-member__info">

                                <span class="team-member__name">Bùi Quang Khải</span>

                                <span class="team-member__job-title">App, Architect</span>
                            </div>
                        </div>
                    </div>
                    <div class="col u-s-m-b-30" style="flex: 0 0 20%; max-width: 20%;">

                        <div class="team-member u-h-100">
                            <div class="team-member__wrap">
                                <div class="aspect aspect--bg-grey-fb aspect--square">

                                    <img class="aspect__img team-member__img" src="images/about/manh.jpg" alt="">
                                </div>

                            </div>
                            <div class="team-member__info">

                                <span class="team-member__name">Âu Xuân Mạnh</span>

                                <span class="team-member__job-title">Team Leader</span>
                            </div>
                        </div>
                    </div>
                    <div class="col u-s-m-b-30" style="flex: 0 0 20%; max-width: 20%;">

                        <div class="team-member u-h-100">
                            <div class="team-member__wrap">
                                <div class="aspect aspect--bg-grey-fb aspect--square">

                                    <img class="aspect__img team-member__img" src="images/about/anh.jpg" alt="">
                                </div>

                            </div>
                            <div class="team-member__info">

                                <span class="team-member__name">Nguyễn Hoàng Anh</span>

                                <span class="team-member__job-title">Manager</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 3 ======-->
</div>
@endsection
{{-- 4. Kết thúc phần nội dung --}}