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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 u-s-m-b-30">
                            <div class="empty">
                                <div class="empty__wrap">

                                    <span class="empty__big-text">SORRY</span>

                                    <span class="empty__text-1">Your search, did not match any products. A partial match of
                                        your keywords is listed below.</span>

                                    <span class="empty__text-2">Related searches:

                                        <a href="{{ route('shop.side_v2') }}">men's clothing</a>

                                        <a href="{{ route('shop.side_v2') }}">mobiles & tablets</a>

                                        <a href="{{ route('shop.side_v2') }}">books & audible</a></span>
                                    <form class="empty__search-form">

                                        <label for="search-label"></label>

                                        <input class="input-text input-text--primary-style" type="text" id="search-label"
                                            placeholder="Search Keywords">

                                        <button class="btn btn--icon fas fa-search" type="submit"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 1 ======-->
    </div>
@endsection
{{-- 4. Kết thúc phần nội dung --}}
