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
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="blog-w-master">
                            <div class="u-s-m-b-60">
                                <div class="blog-w">

                                    <span class="blog-w__h">SEARCH</span>
                                    <form class="blog-search-form">

                                        <label for="post-search"></label>

                                        <input class="input-text input-text--primary-style" type="text" id="post-search"
                                            placeholder="Search">

                                        <button class="btn btn--icon fas fa-search" type="submit"></button>
                                    </form>
                                </div>
                            </div>
                            <div class="u-s-m-b-60">
                                <div class="blog-w">

                                    <span class="blog-w__h">CATEGORIES</span>
                                    <ul class="blog-w__list">
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">Corporate</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">Creative</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">Design</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">News</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">Photography</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="u-s-m-b-60">
                                <div class="blog-w">

                                    <span class="blog-w__h">ARCHIVES</span>
                                    <ul class="blog-w__list">
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">March 2017 (1)</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">December 2017 (3)</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">November 2017 (4)</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">September 2017 (1)</a>
                                        </li>
                                        <li>

                                            <a href="{{ route('blog.LeftSidebar') }}">August 2014 (1)</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="u-s-m-b-60">
                                <div class="blog-w">

                                    <span class="blog-w__h">RECENT POSTS</span>
                                    <ul class="blog-w__b-l">
                                        <li>
                                            <div class="b-l__block">
                                                <div class="b-l__date">

                                                    <span>25</span>

                                                    <span>July</span>

                                                    <span>2018</span>
                                                </div>

                                                <span class="b-l__h">

                                                    <a href="{{ route('blog.detail') }}">Life is an extraordinary Adventure</a></span>

                                                <span class="b-l__p">Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                    text.</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="b-l__block">
                                                <div class="b-l__date">

                                                    <span>25</span>

                                                    <span>July</span>

                                                    <span>2018</span>
                                                </div>

                                                <span class="b-l__h">

                                                    <a href="{{ route('blog.detail') }}">Everyone can draw but need passion for
                                                        it</a></span>

                                                <span class="b-l__p">Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                    text.</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="b-l__block">
                                                <div class="b-l__date">

                                                    <span>25</span>

                                                    <span>July</span>

                                                    <span>2018</span>
                                                </div>

                                                <span class="b-l__h">

                                                    <a href="{{ route('blog.detail') }}">Rap is not an art</a></span>

                                                <span class="b-l__p">Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                    text.</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="u-s-m-b-60">
                                <div class="blog-w">

                                    <span class="blog-w__h">RECENT COMMENTS</span>
                                    <ul class="blog-w__b-l-2">
                                        <li>
                                            <div class="b-l__block">

                                                <span class="b-l__text">admin</span>

                                                <span class="b-l__text">on</span>

                                                <span class="b-l__h-2">

                                                    <a href="{{ route('blog.detail') }}">Life is all about opportunity</a></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="b-l__block">

                                                <span class="b-l__text">admin</span>

                                                <span class="b-l__text">on</span>

                                                <span class="b-l__h-2">

                                                    <a href="{{ route('blog.detail') }}">Be More Confident in 30 Seconds</a></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="b-l__block">

                                                <span class="b-l__text">admin</span>

                                                <span class="b-l__text">on</span>

                                                <span class="b-l__h-2">

                                                    <a href="{{ route('blog.detail') }}">Bury A Body With Me</a></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="b-l__block">

                                                <span class="b-l__text">admin</span>

                                                <span class="b-l__text">on</span>

                                                <span class="b-l__h-2">

                                                    <a href="{{ route('blog.detail') }}">Everything Must Die</a></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="blog-w">

                                    <span class="blog-w__h">TAGS</span>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Dresses</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Shirts & Tops</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Polo Shirts</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Sweaters</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Blazers</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Vests</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Jackets</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="bp bp--img u-s-m-b-30">
                            <div class="bp__wrap">
                                <div class="bp__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-2.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp__info-wrap">
                                    <div class="bp__stat">

                                        <span class="bp__stat-wrap">

                                            <span class="bp__publish-date">

                                                <a href="{{ route('blog.LeftSidebar') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__author">

                                                <a href="{{ route('blog.LeftSidebar') }}">Dayle</a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__category">

                                                <a href="{{ route('blog.LeftSidebar') }}">Learning</a>

                                                <a href="{{ route('blog.LeftSidebar') }}">News</a>

                                                <a href="{{ route('blog.LeftSidebar') }}">Health</a></span></span>
                                    </div>

                                    <span class="bp__h1">

                                        <a href="{{ route('blog.detail') }}">Life is an extraordinary Adventure</a></span>

                                    <span class="bp__h2">A post with the image</span>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Place</a>
                                    </div>
                                    <p class="bp__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <div class="gl-l-r">
                                        <div>

                                            <span class="bp__read-more">

                                                <a href="{{ route('blog.detail') }}">READ MORE</a></span>
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

                                                <a href="{{ route('blog.detail') }}">

                                                    <img class="u-img-fluid" src="images/blog/post-1.jpg" alt=""></a>
                                            </div>
                                            <div>

                                                <a href="{{ route('blog.detail') }}">

                                                    <img class="u-img-fluid" src="images/blog/post-2.jpg" alt=""></a>
                                            </div>
                                            <div>

                                                <a href="{{ route('blog.detail') }}">

                                                    <img class="u-img-fluid" src="images/blog/post-3.jpg" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--====== End - Gallery Code ======-->
                                </div>
                                <div class="bp__info-wrap">
                                    <div class="bp__stat">

                                        <span class="bp__stat-wrap">

                                            <span class="bp__publish-date">

                                                <a href="{{ route('blog.LeftSidebar') }}">

                                                    <span>25 March 2018</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__author">

                                                <a href="{{ route('blog.LeftSidebar') }}">Admin</a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>16</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__category">

                                                <a href="{{ route('blog.LeftSidebar') }}">Drawing</a>

                                                <a href="{{ route('blog.LeftSidebar') }}">Design</a>

                                                <a href="{{ route('blog.LeftSidebar') }}">Illustrator</a></span></span>
                                    </div>

                                    <span class="bp__h1">

                                        <a href="{{ route('blog.detail') }}">Everyone can draw but need passion for it</a></span>

                                    <span class="bp__h2">A post with the gallery</span>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Creativity</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Art</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Design</a>
                                    </div>
                                    <p class="bp__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <div class="gl-l-r">
                                        <div>

                                            <span class="bp__read-more">

                                                <a href="{{ route('blog.detail') }}">READ MORE</a></span>
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

                                    <!--====== Embed Audio Soundcloud ======-->
                                    <iframe
                                        src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/532448574&amp;color=%23333333&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true"></iframe>
                                    <!--====== End - Embed Audio Soundcloud ======-->
                                </div>
                                <div class="bp__info-wrap">
                                    <div class="bp__stat">

                                        <span class="bp__stat-wrap">

                                            <span class="bp__publish-date">

                                                <a href="{{ route('blog.LeftSidebar') }}">

                                                    <span>25 April 2018</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__author">

                                                <a href="{{ route('blog.LeftSidebar') }}">John</a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>99</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__category">

                                                <a href="{{ route('blog.LeftSidebar') }}">Soundcloud</a>

                                                <a href="{{ route('blog.LeftSidebar') }}">Lyrics</a></span></span>
                                    </div>

                                    <span class="bp__h1">

                                        <a href="{{ route('blog.detail') }}">EDM is only dance-floor oriented it has no
                                            emotions</a></span>

                                    <span class="bp__h2">A post with the embed audio</span>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">EDM</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Trance</a>
                                    </div>
                                    <p class="bp__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <div class="gl-l-r">
                                        <div>

                                            <span class="bp__read-more">

                                                <a href="{{ route('blog.detail') }}">READ MORE</a></span>
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

                                    <!--====== Audio ======-->
                                    <audio controls>
                                        <source src="audio/1.mp3">
                                    </audio>
                                    <!--====== End - Audio ======-->
                                </div>
                                <div class="bp__info-wrap">
                                    <div class="bp__stat">

                                        <span class="bp__stat-wrap">

                                            <span class="bp__publish-date">

                                                <a href="{{ route('blog.LeftSidebar') }}">

                                                    <span>25 June 2018</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__author">

                                                <a href="{{ route('blog.LeftSidebar') }}">Doe</a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>15</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__category">

                                                <a href="{{ route('blog.LeftSidebar') }}">Genre</a>

                                                <a href="{{ route('blog.LeftSidebar') }}">Song</a></span></span>
                                    </div>

                                    <span class="bp__h1">

                                        <a href="{{ route('blog.detail') }}">Pop Genre only focusing on stupidity</a></span>

                                    <span class="bp__h2">A post with the audio</span>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Pop</a>
                                    </div>
                                    <p class="bp__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <div class="gl-l-r">
                                        <div>

                                            <span class="bp__read-more">

                                                <a href="{{ route('blog.detail') }}">READ MORE</a></span>
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

                                    <!--====== Video ======-->
                                    <div class="post-video-block">

                                        <a class="post-video-link"></a><video class="post-video"
                                            src="video/video-sample.mp4" poster="video/video-thumbnail.jpg"></video>
                                    </div>
                                    <!--====== End - Video ======-->
                                </div>
                                <div class="bp__info-wrap">
                                    <div class="bp__stat">

                                        <span class="bp__stat-wrap">

                                            <span class="bp__publish-date">

                                                <a href="{{ route('blog.LeftSidebar') }}">

                                                    <span>25 July 2018</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__author">

                                                <a href="{{ route('blog.LeftSidebar') }}">Doe</a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>56</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__category">

                                                <a href="{{ route('blog.LeftSidebar') }}">Video</a>

                                                <a href="{{ route('blog.LeftSidebar') }}">Camera</a></span></span>
                                    </div>

                                    <span class="bp__h1">

                                        <a href="{{ route('blog.detail') }}">Save your movement on a camera</a></span>

                                    <span class="bp__h2">A post with the video</span>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Camera</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Recording</a>
                                    </div>
                                    <p class="bp__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <div class="gl-l-r">
                                        <div>

                                            <span class="bp__read-more">

                                                <a href="{{ route('blog.detail') }}">READ MORE</a></span>
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
                        <div class="bp">
                            <div class="bp__wrap">
                                <div class="bp__thumbnail">

                                    <!--====== Embed Video Youtube ======-->
                                    <iframe src="https://www.youtube.com/embed/qKqSBm07KZk" allowfullscreen></iframe>
                                    <!--====== End - Embed Video Youtube ======-->
                                </div>
                                <div class="bp__info-wrap">
                                    <div class="bp__stat">

                                        <span class="bp__stat-wrap">

                                            <span class="bp__publish-date">

                                                <a href="{{ route('blog.LeftSidebar') }}">

                                                    <span>25 August 2018</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__author">

                                                <a href="{{ route('blog.LeftSidebar') }}">John</a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>4</span></a></span></span>

                                        <span class="bp__stat-wrap">

                                            <span class="bp__category">

                                                <a href="{{ route('blog.LeftSidebar') }}">Youtube</a>

                                                <a href="{{ route('blog.LeftSidebar') }}">Videos</a></span></span>
                                    </div>

                                    <span class="bp__h1">

                                        <a href="{{ route('blog.detail') }}">Oh No! 1 Trillion Videos</a></span>

                                    <span class="bp__h2">A post with the embed video</span>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Recording</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.LeftSidebar') }}">Freetime</a>
                                    </div>
                                    <p class="bp__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <div class="gl-l-r">
                                        <div>

                                            <span class="bp__read-more">

                                                <a href="{{ route('blog.detail') }}">READ MORE</a></span>
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

                                    <a href="{{ route('blog.LeftSidebar') }}">1</a>
                                </li>
                                <li>

                                    <a href="{{ route('blog.LeftSidebar') }}">2</a>
                                </li>
                                <li>

                                    <a href="{{ route('blog.LeftSidebar') }}">3</a>
                                </li>
                                <li>

                                    <a href="{{ route('blog.LeftSidebar') }}">4</a>
                                </li>
                                <li>

                                    <a class="fas fa-angle-right" href="{{ route('blog.LeftSidebar') }}"></a>
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
