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

                                <a href="{{ route('faq') }}">Câu hỏi thường gặp</a>
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
                        <div class="faq">
                            <h3 class="faq__heading">CÂU HỎI THƯỜNG GẶP</h3>
                            <h3 class="faq__heading">Dưới đây là những câu hỏi thường gặp, bạn có thể tìm thấy câu trả
                                lời cho mình.</h3>
                            <p class="faq__text">Chúng tôi cung cấp đa dạng các sản phẩm nội thất với thiết kế tinh tế,
                                phù hợp cho nhiều không gian sống khác nhau. Từ phòng khách, phòng ngủ đến phòng làm
                                việc, mỗi sản phẩm đều được chọn lọc kỹ lưỡng về chất liệu, độ bền và tính thẩm mỹ. Đội
                                ngũ của chúng tôi luôn sẵn sàng hỗ trợ, tư vấn chi tiết nhằm mang đến cho khách hàng
                                trải nghiệm mua sắm tiện lợi, an tâm và hài lòng nhất.</p>
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
                    <div class="col-lg-12">
                        <div id="faq-accordion-group">
                            <div class="faq__list">

                                <a class="faq__question collapsed" href="#faq-1" data-toggle="collapse">Làm thế nào để
                                    tôi nhận được mã giảm giá khi mua đồ nội thất?</a>
                                <div class="faq__answer collapse" id="faq-1" data-parent="#faq-accordion-group">
                                    <p class="faq__text">Bạn có thể nhận mã giảm giá bằng cách đăng ký nhận bản tin từ
                                        website, theo dõi các chương trình khuyến mãi định kỳ hoặc tham gia các sự kiện
                                        ưu đãi dành cho khách hàng thân thiết.</p>
                                </div>
                            </div>
                            <div class="faq__list">

                                <a class="faq__question collapsed" href="#faq-2" data-toggle="collapse">Tôi có cần tạo
                                    tài khoản để mua sản phẩm nội thất không?</a>
                                <div class="faq__answer collapse" id="faq-2" data-parent="#faq-accordion-group">
                                    <p class="faq__text">Bạn có thể mua hàng mà không cần tạo tài khoản. Tuy nhiên, việc
                                        đăng ký tài khoản sẽ giúp bạn theo dõi đơn hàng, lưu thông tin giao hàng và nhận
                                        ưu đãi nhanh chóng hơn.</p>
                                </div>
                            </div>
                            <div class="faq__list">

                                <a class="faq__question collapsed" href="#faq-3" data-toggle="collapse">Làm thế nào để
                                    tôi theo dõi đơn hàng nội thất của mình?</a>
                                <div class="faq__answer collapse" id="faq-3" data-parent="#faq-accordion-group">
                                    <p class="faq__text">Sau khi đặt hàng thành công, hệ thống sẽ gửi email hoặc tin
                                        nhắn xác nhận kèm mã đơn hàng. Bạn có thể sử dụng mã này để theo dõi tình trạng
                                        giao hàng trực tiếp trên website.</p>
                                </div>
                            </div>
                            <div class="faq__list">

                                <a class="faq__question collapsed" href="#faq-4" data-toggle="collapse">Hệ thống bảo mật
                                    thanh toán khi mua nội thất hoạt động như thế nào?</a>
                                <div class="faq__answer collapse" id="faq-4" data-parent="#faq-accordion-group">
                                    <p class="faq__text">Chúng tôi sử dụng hệ thống thanh toán bảo mật với công nghệ mã
                                        hóa thông tin, đảm bảo an toàn tuyệt đối cho các giao dịch và thông tin cá nhân
                                        của khách hàng.</p>
                                </div>
                            </div>
                            <div class="faq__list">

                                <a class="faq__question collapsed" href="#faq-5" data-toggle="collapse">Cửa hàng có
                                    chính sách bán hàng và bảo hành sản phẩm nội thất như thế nào?</a>
                                <div class="faq__answer collapse" id="faq-5" data-parent="#faq-accordion-group">
                                    <p class="faq__text">Tất cả sản phẩm nội thất đều được kiểm tra kỹ trước khi giao và
                                        áp dụng chính sách bảo hành rõ ràng theo từng loại sản phẩm. Thông tin chi tiết
                                        sẽ được cung cấp trong phần mô tả sản phẩm.</p>
                                </div>
                            </div>
                            <div class="faq__list">

                                <a class="faq__question collapsed" href="#faq-6" data-toggle="collapse">Tôi có thể đổi
                                    hoặc trả lại sản phẩm nội thất như thế nào?</a>
                                <div class="faq__answer collapse" id="faq-6" data-parent="#faq-accordion-group">
                                    <p class="faq__text">Khách hàng có thể yêu cầu đổi hoặc trả sản phẩm trong thời gian
                                        quy định nếu sản phẩm bị lỗi kỹ thuật hoặc không đúng mô tả. Sản phẩm cần giữ
                                        nguyên tình trạng ban đầu và đầy đủ phụ kiện.</p>
                                </div>
                            </div>
                            <div class="faq__list">

                                <a class="faq__question collapsed" href="#faq-7" data-toggle="collapse">Cửa hàng hiện hỗ
                                    trợ những phương thức thanh toán nào cho sản phẩm nội thất?</a>
                                <div class="faq__answer collapse" id="faq-7" data-parent="#faq-accordion-group">
                                    <p class="faq__text">Chúng tôi hỗ trợ nhiều hình thức thanh toán như tiền mặt khi
                                        nhận hàng, chuyển khoản ngân hàng và thanh toán trực tuyến qua các cổng thanh
                                        toán an toàn.</p>
                                </div>
                            </div>
                            <div class="faq__list">

                                <a class="faq__question collapsed" href="#faq-8" data-toggle="collapse">Cửa hàng có
                                    những hình thức giao hàng nào đối với sản phẩm nội thất?</a>
                                <div class="faq__answer collapse" id="faq-8" data-parent="#faq-accordion-group">
                                    <p class="faq__text">Chúng tôi cung cấp dịch vụ giao hàng tận nơi, hỗ trợ lắp đặt
                                        đối với các sản phẩm nội thất cồng kềnh và đảm bảo giao hàng đúng hẹn theo khu
                                        vực của khách hàng</p>
                                </div>
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