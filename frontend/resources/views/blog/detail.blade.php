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

        <!--====== Detail Post ======-->
        <div class="detail-post">
            <div class="bp-detail">
                <div class="bp-detail__thumbnail">

                    <!--====== Image Code ======-->
                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                        <img class="aspect__img" src="{{ asset('images/blog/giuong1.jpg') }}" alt=""></a>
                    <!--====== End - Image Code ======-->
                </div>
                <div class="bp-detail__info-wrap">
                    <div class="bp-detail__stat">

                        <span class="bp-detail__h1">

                            <a href="{{ route('blog.detail') }}">Cuộc sống là một chuyến phiêu lưu phi thường</a></span>
                        <div class="blog-t-w">

                            <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                href="{{ route('blog.SidebarNone') }}">Du lịch</a>

                            <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                href="{{ route('blog.SidebarNone') }}">Văn hóa</a>

                            <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                href="{{ route('blog.SidebarNone') }}">Địa điểm</a>
                            <p class="bp-detail__p">Không gian phòng ngủ trong hình gợi lên cảm giác yên bình và ấm áp,
                                nơi con người có thể tạm gác lại những lo toan của cuộc sống bên ngoài để tìm về sự thư
                                thái sâu lắng. Ánh đèn vàng dịu chạy dọc khung giường như một dải sáng dẫn lối, tạo nên
                                bầu không khí nhẹ nhàng nhưng đầy tính thẩm mỹ. Mọi chi tiết trong căn phòng — từ chất
                                liệu gỗ mộc mạc, tông màu nâu ấm cho đến cách bài trí tối giản — đều toát lên sự tinh tế
                                và sang trọng.</p>
                            <blockquote class="bp-detail__q"><i class="fas fa-quote-left"></i>

                                <span class="bp-detail__q-title">Địa điểm thoải mái nhất trên thế giới chính là CHIẾC
                                    GIƯỜNG của bạn</span><cite class="bp-detail__q-citation">— BÙI KIM ĐẠT</cite>
                            </blockquote>
                            <p class="bp-detail__p">Đây không chỉ là nơi để nghỉ ngơi, mà còn là góc nhỏ giúp mỗi người
                                cảm nhận rõ ràng hơn giá trị của việc sống chậm, trân trọng những khoảnh khắc bình yên
                                giữa nhịp sống hiện đại. Một không gian như vậy khiến ta nhận ra rằng đôi khi niềm hạnh
                                phúc lại đến từ những điều đơn giản nhất: một chiếc giường êm, một căn phòng ấm, và một
                                buổi tối yên tĩnh để tâm hồn được thả lỏng.</p>
                            <div class="post-center-wrap">
                                <ul class="bp-detail__social-list">
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
            </div>
            <!--====== End - Detail Post ======-->
            <div class="u-s-p-b-60">
                <div class="d-meta">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- <div class="d-meta__comment-arena">

                                <span class="d-meta__text u-s-m-b-36">6 bình luận về "Cuộc sống là chuyến phiêu lưu phi thường"</span>
                                <div class="d-meta__comments u-s-m-b-30">
                                    <ol>
                                        <li>

                                            
                                            <div class="d-meta__p-comment">
                                                <div class="p-comment__wrap1">
                                                    <div class="aspect aspect--square p-comment__img-wrap">

                                                        <img src="images/blog/avatar.jpg" alt=""></div>
                                                </div>
                                                <div class="p-comment__wrap2">

                                                    <span class="p-comment__author">Hoàng Anh</span>

                                                    <span class="p-comment__timestamp">

                                                        <a href="#">

                                                            <span>25 - 03 - 2015 at 3:55pm</span></a></span>
                                                    <p class="p-comment__paragraph">Giường siêu êm luôn mọi người ơi.</p>

                                                    <a class="p-comment__reply" href="#">Trả lời</a>
                                                </div>
                                            </div>
                                            
                                            <ol class="comment-children">
                                                <li>
                                                    
                                                    <div class="d-meta__p-comment">
                                                        <div class="p-comment__wrap1">
                                                            <div class="aspect aspect--square p-comment__img-wrap">

                                                                <img src="images/blog/avatar-2.jpg" alt=""></div>
                                                        </div>
                                                        <div class="p-comment__wrap2">

                                                            <span class="p-comment__author">Trương Thành Nam</span>

                                                            <span class="p-comment__timestamp">

                                                                <a href="#">

                                                                    <span>27 - 05 - 2015 at 3:55pm</span></a></span>
                                                            <p class="p-comment__paragraph">Giường này nằm mà muốn ngủ đông luôn á shop.</p>

                                                            <a class="p-comment__reply" href="#">Trả lời</a>
                                                        </div>
                                                    </div>
                                                    
                                                </li>
                                            </ol>
                                            <ol class="comment-children">
                                                        <li>

                                                            
                                                            <div class="d-meta__p-comment">
                                                                <div class="p-comment__wrap1">
                                                                    <div class="aspect aspect--square p-comment__img-wrap">

                                                                        <img src="images/blog/avatar-3.jpg" alt=""></div>
                                                                </div>
                                                                <div class="p-comment__wrap2">

                                                                    <span class="p-comment__author">Xuân Mạnh</span>

                                                                    <span class="p-comment__timestamp">

                                                                        <a href="#">

                                                                            <span>25 - 09 - 2015 at 3:55pm</span></a></span>
                                                                    <p class="p-comment__paragraph">Chiếc giường 10 điểm không có nhưng.</p>

                                                                    <a class="p-comment__reply" href="#">Trả lời</a>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                        </li>
                                                    </ol>
                                                    <ol class="comment-children">
                                                                <li>

                                                                    
                                                                    <div class="d-meta__p-comment">
                                                                        <div class="p-comment__wrap1">
                                                                            <div class="aspect aspect--square p-comment__img-wrap">

                                                                                <img src="images/blog/avatar-4.jpg" alt=""></div>
                                                                        </div>
                                                                        <div class="p-comment__wrap2">

                                                                            <span class="p-comment__author">Khải Bùi</span>

                                                                            <span class="p-comment__timestamp">

                                                                                <a href="#">

                                                                                    <span>10 - 06 - 2015 at 3:55pm</span></a></span>
                                                                            <p class="p-comment__paragraph">Mơ đẹp nhé các tình yêu.</p>

                                                                            <a class="p-comment__reply" href="#">Trả lời</a>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </li>
                                                            </ol>
                                        </li>
                                    </ol>
                                </div>

                                <span class="d-meta__text-2 u-s-m-b-6">Tham gia thảo luận</span>

                                <span class="d-meta__text-3 u-s-m-b-16">Địa chỉ email của bạn sẽ không được công khai. Các trường bắt buộc được đánh dấu *</span>
                                <form class="respond__form">
                                    <div class="respond__group">
                                        <div class="u-s-m-b-15">

                                            <label class="gl-label" for="comment">BÌNH LUẬN *</label><textarea class="text-area text-area--primary-style" id="comment"></textarea></div>
                                        <div>
                                            <p class="u-s-m-b-30">

                                                <label class="gl-label" for="responder-name">TÊN *</label>

                                                <input class="input-text input-text--primary-style" type="text" id="responder-name"></p>
                                            <p class="u-s-m-b-30">

                                                <label class="gl-label" for="responder-email">EMAIL *</label>

                                                <input class="input-text input-text--primary-style" type="text" id="responder-email"></p>
                                        </div>
                                    </div>
                                    <div>

                                        <button class="btn btn--e-brand-shadow" type="submit">GỬI BÌNH LUẬN</button></div>
                                </form>
                            </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->
        </div>
    </div>
</div>
<!--====== End - App Content ======-->
<!--====== End - Main App ======-->
@endsection
{{-- 4. Kết thúc phần nội dung --}}