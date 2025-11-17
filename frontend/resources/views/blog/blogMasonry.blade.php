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
            <div class="container">
                <div class="blog-m">
                    <div class="row blog-m-init">
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-2.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Life is an extraordinary Adventure</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Gallery Code ======-->
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
                                    <!--====== End - Gallery Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 March 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Admin</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>16</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Drawing</a>

                                        <a href="{{ route('blog.Masonry') }}">Design</a>

                                        <a href="{{ route('blog.Masonry') }}">Illustrator</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Everyone can draw but need passion for it</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Creativity</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Art</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Design</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Embed Audio Soundcloud ======-->
                                    <iframe
                                        src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/532448574&amp;color=%23333333&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true"></iframe>
                                    <!--====== End - Embed Audio Soundcloud ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 April 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">John</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>99</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Soundcloud</a>

                                        <a href="{{ route('blog.Masonry') }}">Lyrics</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">EDM is only dance-floor oriented it has no
                                            emotions</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">EDM</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Trance</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Audio ======-->
                                    <audio controls>
                                        <source src="audio/1.mp3">
                                    </audio>
                                    <!--====== End - Audio ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 June 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Doe</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>15</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Genre</a>

                                        <a href="{{ route('blog.Masonry') }}">Song</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Pop Genre only focusing on stupidity</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Pop</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Video ======-->
                                    <div class="post-video-block">

                                        <a class="post-video-link"></a><video class="post-video"
                                            src="video/video-sample.mp4" poster="video/video-thumbnail.jpg"></video>
                                    </div>
                                    <!--====== End - Video ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 July 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Doe</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>56</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Video</a>

                                        <a href="{{ route('blog.Masonry') }}">Camera</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Save your movement on a camera</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Camera</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Recording</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Embed Video Youtube ======-->
                                    <iframe src="https://www.youtube.com/embed/qKqSBm07KZk" allowfullscreen></iframe>
                                    <!--====== End - Embed Video Youtube ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 August 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">John</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>4</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Youtube</a>

                                        <a href="{{ route('blog.Masonry') }}">Videos</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Oh No! 1 Trillion Videos</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Recording</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Freetime</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-4.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">It's time for beer</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-5.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Tell me difference between smoke and vape</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-6.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Most people think the wars are a thing of the
                                            past</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-7.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Preparations are being made for a final war</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-8.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Trophies are over now rigging is prepared</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-9.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Peace is a mock word created by marionette</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-10.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">You are better than that</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-11.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Cancel that mark i need</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-m__element">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="{{ route('blog.detail') }}">

                                        <img class="aspect__img" src="images/blog/post-12.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a href="{{ route('blog.Masonry') }}">

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="{{ route('blog.detail') }}"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a href="{{ route('blog.Masonry') }}">Learning</a>

                                        <a href="{{ route('blog.Masonry') }}">News</a>

                                        <a href="{{ route('blog.Masonry') }}">Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="{{ route('blog.detail') }}">Wait till its open</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2"
                                            href="{{ route('blog.Masonry') }}">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="post-center-wrap u-s-p-y-60">

                    <!--====== Pagination ======-->
                    <ul class="blog-pg">
                        <li class="blog-pg--active">

                            <a href="{{ route('blog.Masonry') }}">1</a>
                        </li>
                        <li>

                            <a href="{{ route('blog.Masonry') }}">2</a>
                        </li>
                        <li>

                            <a href="{{ route('blog.Masonry') }}">3</a>
                        </li>
                        <li>

                            <a href="{{ route('blog.Masonry') }}">4</a>
                        </li>
                        <li>

                            <a class="fas fa-angle-right" href="{{ route('blog.Masonry') }}"></a>
                        </li>
                    </ul>
                    <!--====== End - Pagination ======-->
                </nav>
            </div>
        </div>
        <!--====== End - Section 1 ======-->
    </div>
@endsection
