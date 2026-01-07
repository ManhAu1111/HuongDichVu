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

                                <a href="{{ route('shop.index') }}">Trang Chủ</a>
                            </li>
                            <li class="is-marked">

                                <a href="{{ route('contact') }}">Liên Hệ</a>
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
                        <div class="g-map">
                            <iframe src="https://www.google.com/maps?q=Trường+Đại+học+Kiến+trúc+Hà+Nội&output=embed"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
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

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                        <div class="contact-o u-h-100">
                            <div class="contact-o__wrap">
                                <div class="contact-o__icon"><i class="fas fa-phone-volume"></i></div>

                                <span class="contact-o__info-text-1">SỐ ĐIỆN THOẠI</span>

                                <span class="contact-o__info-text-2">(+84) 824 948 677</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                        <div class="contact-o u-h-100">
                            <div class="contact-o__wrap">
                                <div class="contact-o__icon"><i class="fas fa-map-marker-alt"></i></div>

                                <span class="contact-o__info-text-1">ĐỊA CHỈ</span>

                                <span class="contact-o__info-text-2">57 Phố Đại An, Văn Quán, Hà Đông, Hầ Nội</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                        <div class="contact-o u-h-100">
                            <div class="contact-o__wrap">
                                <div class="contact-o__icon"><i class="far fa-clock"></i></div>

                                <span class="contact-o__info-text-1">THỜI GIAN LÀM VIỆC</span>

                                <span class="contact-o__info-text-2">5 Ngày trên tuần</span>

                                <span class="contact-o__info-text-2">Từ 8:30 đến 15:30</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 3 ======-->


    <!--====== Section 4 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-area u-h-100">
                            <div class="contact-area__heading">
                                <h2>Liên hệ với chúng tôi</h2>
                            </div>
                            <form class="contact-f" method="post" action="{{ route('shop.index') }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 u-h-100">
                                        <div class="u-s-m-b-30">

                                            <label for="c-name"></label>

                                            <input
                                                class="input-text input-text--border-radius input-text--primary-style"
                                                type="text" id="c-name" placeholder="Họ và Tên (Bắt buộc)" required>
                                        </div>
                                        <div class="u-s-m-b-30">

                                            <label for="c-email"></label>

                                            <input
                                                class="input-text input-text--border-radius input-text--primary-style"
                                                type="text" id="c-email" placeholder="Email (Bắt buộc)" required>
                                        </div>
                                        <div class="u-s-m-b-30">

                                            <label for="c-subject"></label>

                                            <input
                                                class="input-text input-text--border-radius input-text--primary-style"
                                                type="text" id="c-subject" placeholder="Chủ đề (Bắt buộc)" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 u-h-100">
                                        <div class="u-s-m-b-30">

                                            <label for="c-message"></label><textarea
                                                class="text-area text-area--border-radius text-area--primary-style"
                                                id="c-message" placeholder="Soạn tin nhắn (Bắt buộc)"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">

                                        <button class="btn btn--e-brand-b-2" type="submit">Gửi Tin Nhắn</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 4 ======-->
</div>
@endsection
{{-- 4. Kết thúc phần nội dung --}}