<footer>
    <div class="outer-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="outer-footer__content u-s-m-b-40">

                        <span class="outer-footer__content-title">Liên Hệ</span>
                        <div class="outer-footer__text-wrap"><i class="fas fa-home"></i>

                            <span>Trường Đại học Kiến trúc Hà Nội</span>
                        </div>
                        <div class="outer-footer__text-wrap"><i class="fas fa-phone-volume"></i>

                            <span>(+84) 824 948 677</span>
                        </div>
                        <div class="outer-footer__text-wrap"><i class="far fa-envelope"></i>

                            <span>datbk2705@gmail.com</span>
                        </div>
                        <div class="outer-footer__social">
                            <ul>
                                <li>

                                    <a class="s-fb--color-hover"
                                        href="https://www.facebook.com/kim.at.618517?locale=vi_VN"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>

                                    <a class="s-tw--color-hover" href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>

                                    <a class="s-youtube--color-hover" href="#"><i class="fab fa-youtube"></i></a>
                                </li>
                                <li>

                                    <a class="s-insta--color-hover" href="#"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>

                                    <a class="s-gplus--color-hover" href="#"><i class="fab fa-google-plus-g"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="outer-footer__content u-s-m-b-40">

                                <span class="outer-footer__content-title">Thông Tin</span>
                                <div class="outer-footer__list-wrap">
                                    <ul>
                                        <li>

                                            <a href="{{ route('cart') }}">Giỏ hàng</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('dashboard') }}">Tài khoản</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('shop.side_v2') }}">Nhà sản xuất</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('dash.payment_option') }}">Tài chính</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('shop.side_v2') }}">Cửa hàng</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="outer-footer__content u-s-m-b-40">
                                <div class="outer-footer__list-wrap">

                                    <span class="outer-footer__content-title">Về Công Ty</span>
                                    <ul>
                                        <li>

                                            <a href="{{ route('about') }}">Giới thiệu</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('contact') }}">Liên hệ</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('shop.index') }}">Sơ đồ trang web</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('dash.my_order') }}">Giao hàng</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('shop.side_v2') }}">Hệ thống cửa hàng</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="outer-footer__content">

                        <span class="outer-footer__content-title">Đăng ký nhận thông báo mới</span>
                        <form class="newsletter">
                            <div class="u-s-m-b-15">
                                <div class="radio-box newsletter__radio">

                                    <input type="radio" id="male" name="gender">
                                    <div class="radio-box__state radio-box__state--primary">

                                        <label class="radio-box__label" for="male">Nam</label>
                                    </div>
                                </div>
                                <div class="radio-box newsletter__radio">

                                    <input type="radio" id="female" name="gender">
                                    <div class="radio-box__state radio-box__state--primary">

                                        <label class="radio-box__label" for="female">Nữ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="newsletter__group">

                                <label for="newsletter"></label>

                                <input class="input-text input-text--only-white" type="text" id="newsletter"
                                    placeholder="Điền Email của bạn">

                                <button class="btn btn--e-brand newsletter__btn" type="submit">Đăng Ký</button>
                            </div>

                            <span class="newsletter__text">Đăng ký danh sách email để nhận thông báo về khuyến mãi, sản
                                phẩm mới, giảm giá và mã ưu đãi.</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lower-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="lower-footer__content">
                        <div class="lower-footer__copyright">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>