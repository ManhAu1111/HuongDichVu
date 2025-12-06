<script>
    @php
    echo "window.APP_USER_ID = ".json_encode($globalUserId).
    ";";
    @endphp
</script>

<header class="header--style-1 header--box-shadow">
    <!--====== Nav 1 ======-->
    <nav class="primary-nav primary-nav-wrapper--border">
        <div class="container">

            <!--====== Primary Nav ======-->
            <div class="primary-nav">

                <!--====== Main Logo ======-->

                <a class="main-logo" href="{{ route('shop.index') }}">

                    <img src="{{ asset('images/logo/logo-1.png') }}" alt=""></a>
                <!--====== End - Main Logo ======-->


                <!--====== Search Form ======-->
                <form class="main-form" method="GET" action="{{ route('shop.side_v2') }}">
                    <label for="main-search"></label>


                    <input class="input-text input-text--border-radius input-text--style-1" type="text" id="main-search"
                        name="search" value="{{ request('search') }}" placeholder="Search">

                    <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
                </form>
                <!--====== End - Search Form ======-->


                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation">

                    <button class="btn btn--icon toggle-button fas fa-cogs" type="button"></button>

                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">

                        <span class="ah-close">✕ Close</span>

                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                            <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">

                                <a><i class="far fa-user-circle"></i></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <ul style="width:120px">
                                    <li>

                                        <a href="{{ route('dashboard') }}"><i class="fas fa-user-circle u-s-m-r-6"></i>

                                            <span>Account</span></a>
                                    </li>
                                    <li>

                                        <a href="{{ route('register') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>

                                            <span>Signup</span></a>
                                    </li>
                                    <li>

                                        <a href="{{ route('login') }}"><i class="fas fa-lock u-s-m-r-6"></i>

                                            <span>Signin</span></a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-lock-open u-s-m-r-6"></i>
                                            <span>Signout</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>

                                </ul>
                                <!--====== End - Dropdown ======-->
                            </li>
                            <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Settings">

                                <a><i class="fas fa-user-cog"></i></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <ul style="width:120px">
                                    <li class="has-dropdown has-dropdown--ul-right-100">

                                        <a>Language<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:120px">
                                            <li>

                                                <a class="u-c-brand">ENGLISH</a>
                                            </li>
                                            <li>

                                                <a>ARABIC</a>
                                            </li>
                                            <li>

                                                <a>FRANCAIS</a>
                                            </li>
                                            <li>

                                                <a>ESPANOL</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-right-100">

                                        <a>Currency<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:225px">
                                            <li>

                                                <a class="u-c-brand">$ - US DOLLAR</a>
                                            </li>
                                            <li>

                                                <a>£ - BRITISH POUND STERLING</a>
                                            </li>
                                            <li>

                                                <a>€ - EURO</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                </ul>
                                <!--====== End - Dropdown ======-->
                            </li>
                            <li data-tooltip="tooltip" data-placement="left" title="Contact">

                                <a href="tel:+0900901904"><i class="fas fa-phone-volume"></i></a>
                            </li>
                            <li data-tooltip="tooltip" data-placement="left" title="Mail">

                                <a href="mailto:contact@domain.com"><i class="far fa-envelope"></i></a>
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->
            </div>
            <!--====== End - Primary Nav ======-->
        </div>
    </nav>
    <!--====== End - Nav 1 ======-->


    <!--====== Nav 2 ======-->
    <nav class="secondary-nav-wrapper">
        <div class="container">

            <!--====== Secondary Nav ======-->
            <div class="secondary-nav">

                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation1">

                    <button class="btn btn--icon toggle-mega-text toggle-button" type="button">M</button>

                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">

                        <span class="ah-close">✕ Close</span>

                        <!--====== List ======-->
                        <ul class="ah-list">
                            <li class="has-dropdown">

                                <span class="mega-text">M</span>

                                <!--====== Mega Menu ======-->

                                <span class="js-menu-toggle"></span>
                                <div class="mega-menu">
                                    <div class="mega-menu-wrap">
                                        <div class="mega-menu-list">
                                            <ul>
                                                <li class="js-active">

                                                    <a href="{{ route('shop.side_v2') }}"><i
                                                            class="fas fa-tv u-s-m-r-6"></i>

                                                        <span>furniture</span></a>

                                                    <span class="js-menu-toggle js-toggle-mark"></span>
                                                </li>
                                                <li>

                                                    <a href="{{ route('shop.side_v2') }}"><i
                                                            class="fas fa-female u-s-m-r-6"></i>

                                                        <span>modern</span></a>

                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>

                                                    <a href="{{ route('shop.side_v2') }}"><i
                                                            class="fas fa-male u-s-m-r-6"></i>

                                                        <span>classic</span></a>

                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!--====== Electronics ======-->
                                        <div class="mega-menu-content js-active">

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Lounge chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Office chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Gaming chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Rocking chair</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">table</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Coffee table</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Office desk</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Nightstand</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Dining table</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">cabinet</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Wardrobe</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Shoe cabinet</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Bookshelf
                                                                cabinet</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Display cabinet</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">shelves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Wall shelves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Floating shelves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Corner shelves</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">folding bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">single bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">double bed</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>
                                        </div>
                                        <!--====== End - Electronics ======-->


                                        <!--====== Modern ======-->
                                        <div class="mega-menu-content">

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src={{ asset('images/banners/banner-mega-1.jpg') }}
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src={{ asset('images/banners/banner-mega-2.jpg') }}
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Modern dining
                                                                chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Minimalist chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Contemporary
                                                                armchair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Sleek office
                                                                chair</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">table</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Modern coffee
                                                                table</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Minimalist desk</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Modern dining
                                                                table</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Glass side table</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">cabinet</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Modern wardrobe</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Sliding door
                                                                cabinet</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Modern TV
                                                                cabinet</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Handle-less kitchen
                                                                cabinet</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">shelves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Floating wall
                                                                shelves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Geometric
                                                                shelves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Metal-frame
                                                                shelves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Modern corner
                                                                shelf</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Platform bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Upholstered bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Modern queen bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Storage bed</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-9 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="{{ asset('images/banners/banner-mega-3.jpg') }}"
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="{{ asset('images/banners/banner-mega-4.jpg') }}"
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                        </div>
                                        <!--====== End - Modern ======-->


                                        <!--====== Classic ======-->
                                        <div class="mega-menu-content">

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-4 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="{{ asset('images/banners/banner-mega-5.jpg') }}"
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="{{ asset('images/banners/banner-mega-6.jpg') }}"
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="{{ asset('images/banners/banner-mega-7.jpg') }}"
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Classic carved
                                                                armchair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Vintage lounge
                                                                chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Antique dining
                                                                chair</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Victorian accent
                                                                chair</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">table</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Classic carved
                                                                dining table</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Antique coffee
                                                                table</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Vintage tea
                                                                table</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Classic wooden
                                                                desk</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">cabinet</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Classic wardrobe</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Antique display
                                                                cabinet</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Vintage book
                                                                cabinet</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Carved sideboard</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">shelves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Classic wooden
                                                                shelves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Carved wall
                                                                shelf</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Vintage corner
                                                                shelf</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Decorative
                                                                bookshelf</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Classic carved
                                                                bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Vintage queen
                                                                bed</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Royal-style bed
                                                                frame</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Antique wooden
                                                                bed</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="{{ asset('images/banners/banner-mega-8.jpg') }}"
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="{{ asset('images/banners/banner-mega-9.jpg') }}"
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                        </div>
                                        <!--====== End - Classic ======-->
                                    </div>
                                </div>
                                <!--====== End - Mega Menu ======-->
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->


                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation2">

                    <button class="btn btn--icon toggle-button fas fa-cog" type="button"></button>

                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">

                        <span class="ah-close">✕ Close</span>

                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                            <li>

                                <a href="{{ route('shop.side_v2') }}">NEW ARRIVALS</a>
                            </li>
                            <li class="has-dropdown">

                                <a>PAGES<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <ul style="width:170px">
                                    <li>

                                        <a href="{{ route('cart') }}">Cart</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('wishlist') }}">Wishlist</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('checkout') }}">Checkout</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('faq') }}">FAQ</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('about') }}">About us</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('contact') }}">Contact</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('404') }}">404</a>
                                    </li>
                                </ul>
                                <!--====== End - Dropdown ======-->
                            </li>
                            <li class="has-dropdown">

                                <a>BLOG<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <ul style="width:200px">
                                    <li>

                                        <a href="{{ route('blog.SidebarNone') }}">Blog Sidebar None</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('blog.detail') }}">Blog Details</a>
                                    </li>
                                </ul>
                                <!--====== End - Dropdown ======-->
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->


                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation3">

                    <button class="btn btn--icon toggle-button fas fa-shopping-bag toggle-button-shop"
                        type="button"></button>

                    <span class="total-item-round">2</span>

                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">

                        <span class="ah-close">✕ Close</span>

                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                            <li>

                                <a href="{{ route('shop.index') }}"><i class="fas fa-home"></i></a>
                            </li>
                            <li>

                                <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></a>
                            </li>
                            <li class="has-dropdown">

                                <a class="mini-cart-shop-link"><i class="fas fa-shopping-bag"></i>

                                    <span class="total-item-round">2</span></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <div class="mini-cart">

                                    <div class="mini-product-container gl-scroll u-s-m-b-15" id="mini-cart-list">
                                        <!-- JS sẽ tự render -->
                                    </div>

                                    <div class="mini-product-stat">
                                        <div class="mini-total">
                                            <span class="subtotal-text">TẠM TÍNH</span>
                                            <span class="subtotal-value" id="mini-cart-subtotal">0 đ</span>
                                        </div>

                                        <div class="mini-action">
                                            <a class="mini-link btn--e-brand-b-2" href="{{ route('checkout') }}">TIẾN
                                                HÀNH THANH TOÁN</a>
                                            <a class="mini-link btn--e-transparent-secondary-b-2"
                                                href="{{ route('cart') }}">XEM GIỎ HÀNG</a>
                                        </div>
                                    </div>

                                </div>
                                <!--====== End - Dropdown ======-->
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->
            </div>
            <!--====== End - Secondary Nav ======-->
        </div>
    </nav>
    <!--====== End - Nav 2 ======-->
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const USER_ID = window.APP_USER_ID;
        if (!USER_ID) return;

        const API_CART = "http://127.0.0.1:8002/api/cart";

        const listEl = document.getElementById("mini-cart-list");
        const subtotalEl = document.getElementById("mini-cart-subtotal");
        const badgeEls = document.querySelectorAll(".total-item-round");

        // =====================================
        // Fix URL ảnh tuyệt đối (chống 404 ở /product/*)
        // =====================================
        function fixImageUrl(path) {
            if (!path) return "";

            // Nếu API đã trả URL đầy đủ → giữ nguyên
            if (path.startsWith("http")) return path;

            // Xóa mọi dấu "/" dư đầu đường dẫn
            path = path.replace(/^\/+/, "");

            // Ép thành URL tuyệt đối
            return "http://127.0.0.1:8000/" + path;
        }

        // =====================================
        // Hàm load dropdown cart
        // =====================================
        window.loadMiniCart = function loadMiniCart() {
            fetch(`${API_CART}?user_id=${USER_ID}`)
                .then(res => res.json())
                .then(data => {

                    const items = data.items ?? [];
                    let subtotal = 0;

                    if (listEl) listEl.innerHTML = "";

                    items.forEach(item => {

                        subtotal += Number(item.subtotal);

                        const imageUrl = fixImageUrl(item.primary_image);

                        if (listEl) {
                            listEl.innerHTML += `
                        <div class="card-mini-product">
                            <div class="mini-product">
                                <div class="mini-product__image-wrapper">
                                    <a class="mini-product__link" href="/product/${item.product_id}">
                                        <img class="u-img-fluid" src="${imageUrl}" alt="">
                                    </a>
                                </div>

                                <div class="mini-product__info-wrapper">
                                    <span class="mini-product__name">
                                        <a href="/product/${item.product_id}">
                                            ${item.product_name}
                                        </a>
                                    </span>

                                    <span class="mini-product__quantity">${item.quantity} x</span>
                                    <span class="mini-product__price">${item.price.toLocaleString('vi-VN')} đ</span>
                                </div>
                            </div>

                            <a class="mini-product__delete-link far fa-trash-alt" data-id="${item.id}"></a>
                        </div>`;
                        }
                    });

                    // Cập nhật tạm tính
                    if (subtotalEl) {
                        subtotalEl.innerText = subtotal.toLocaleString("vi-VN") + " đ";
                    }

                    // Cập nhật badge ALL vị trí
                    badgeEls.forEach(badge => badge.innerText = items.length);

                    // Xóa sản phẩm dropdown
                    document.querySelectorAll(".mini-product__delete-link").forEach(btn => {
                        btn.addEventListener("click", () => {

                            fetch(`${API_CART}/${btn.dataset.id}`, {
                                    method: "DELETE"
                                })
                                .then(() => {
                                    loadMiniCart(); // reload dropdown
                                    location.reload(); // reload cả trang
                                });
                        });
                    });

                });
        }

        loadMiniCart(); // chạy lần đầu
    });
</script>