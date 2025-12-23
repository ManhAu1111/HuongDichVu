@extends('layouts.app')

@section('title', 'Ludus - Chi Tiết Bài Viết 2')

@section('content')
<div class="app-content">
    <div class="u-s-p-y-90">
        <div class="detail-post">
            <div class="bp-detail">
                <div class="bp-detail__thumbnail">
                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="#">
                        <img class="aspect__img" src="{{ asset('images/blog/post-2.jpg') }}" alt="">
                    </a>
                </div>

                <div class="bp-detail__info-wrap">
                    <span class="bp-detail__h1">
                        <a href="#">Chiếc giường mang phong cách sang trọng, quý phái</a>
                    </span>

                    <div class="blog-t-w">
                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                            href="{{ route('blog.SidebarNone') }}">Thiết kế</a>
                        <a class="gl-tag btn--e-transparent-hover-brand-b-2" href="{{ route('blog.SidebarNone') }}">Nội
                            thất</a>
                    </div>

                    <p class="bp-detail__p">
                        Chiếc giường được thiết kế theo phong cách hiện đại, kết hợp hài hòa giữa thẩm mỹ và công năng,
                        mang lại trải nghiệm nghỉ ngơi cao cấp cho người sử dụng.
                    </p>

                    <blockquote class="bp-detail__q">
                        <i class="fas fa-quote-left"></i>
                        <span class="bp-detail__q-title">
                            Giấc ngủ chất lượng bắt đầu từ một chiếc giường hoàn hảo
                        </span>
                        <cite class="bp-detail__q-citation">— LUDUS</cite>
                    </blockquote>

                    <p class="bp-detail__p">
                        Không chỉ là vật dụng nội thất, chiếc giường còn là điểm nhấn tạo nên sự sang trọng
                        cho toàn bộ không gian phòng ngủ.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection