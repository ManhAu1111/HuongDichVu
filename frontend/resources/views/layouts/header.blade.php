<header class="header--style-1 header--box-shadow">
    <!--====== Nav 1 ======-->
    <nav class="primary-nav primary-nav-wrapper--border">
        <div class="container">

            <!--====== Primary Nav ======-->
            <div class="primary-nav">

                <!--====== Main Logo ======-->

                <a class="main-logo" href="{{ route('shop.index') }}">

                    <img src="images/logo/logo-1.png" alt=""></a>
                <!--====== End - Main Logo ======-->


                <!--====== Search Form ======-->
                <form class="main-form">

                    <label for="main-search"></label>

                    <input class="input-text input-text--border-radius input-text--style-1" type="text" id="main-search"
                        placeholder="Search">

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

                                        <a href="{{ route('register') }}"><i class="fas fa-lock-open u-s-m-r-6"></i>

                                            <span>Signout</span></a>
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

                                                        <span>Electronics</span></a>

                                                    <span class="js-menu-toggle js-toggle-mark"></span>
                                                </li>
                                                <li>

                                                    <a href="{{ route('shop.side_v2') }}"><i
                                                            class="fas fa-female u-s-m-r-6"></i>

                                                        <span>Women's Clothing</span></a>

                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>

                                                    <a href="{{ route('shop.side_v2') }}"><i
                                                            class="fas fa-male u-s-m-r-6"></i>

                                                        <span>Men's Clothing</span></a>

                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>

                                                    <a href="{{ route('shop.index') }}"><i
                                                            class="fas fa-utensils u-s-m-r-6"></i>

                                                        <span>Food & Supplies</span></a>

                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>

                                                    <a href="{{ route('shop.index') }}"><i
                                                            class="fas fa-couch u-s-m-r-6"></i>

                                                        <span>Furniture & Decor</span></a>

                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>

                                                    <a href="{{ route('shop.index') }}"><i
                                                            class="fas fa-football-ball u-s-m-r-6"></i>

                                                        <span>Sports & Game</span></a>

                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>

                                                    <a href="{{ route('shop.index') }}"><i
                                                            class="fas fa-heartbeat u-s-m-r-6"></i>

                                                        <span>Beauty & Health</span></a>

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

                                                            <a href="{{ route('shop.side_v2') }}">3D PRINTER &
                                                                SUPPLIES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">3d Printer</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">3d Printing Pen</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">3d Printing
                                                                Accessories</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">3d Printer Module
                                                                Board</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">HOME AUDIO &
                                                                VIDEO</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">TV Boxes</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">TC Receiver &
                                                                Accessories</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Display Dongle</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Home Theater
                                                                System</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">MEDIA PLAYERS</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Earphones</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Mp3 Players</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Speakers & Radios</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Microphones</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">VIDEO GAME
                                                                ACCESSORIES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Nintendo Video Games
                                                                Accessories</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Sony Video Games
                                                                Accessories</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Xbox Video Games
                                                                Accessories</a>
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

                                                            <a href="{{ route('shop.side_v2') }}">SECURITY &
                                                                PROTECTION</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Security Cameras</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Alarm System</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Security Gadgets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">CCTV Security &
                                                                Accessories</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">PHOTOGRAPHY &
                                                                CAMERA</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Digital Cameras</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Sport Camera &
                                                                Accessories</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Camera
                                                                Accessories</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Lenses &
                                                                Accessories</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">ARDUINO
                                                                COMPATIBLE</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Raspberry Pi & Orange
                                                                Pi</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Module Board</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Smart Robot</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Board Kits</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">DSLR Camera</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Nikon Cameras</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Canon Camera</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Sony Camera</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">DSLR Lenses</a>
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

                                                            <a href="{{ route('shop.side_v2') }}">NECESSARY
                                                                ACCESSORIES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Flash Cards</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Memory Cards</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Flash Pins</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Compact Discs</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-9 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="images/banners/banner-mega-0.jpg" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                        </div>
                                        <!--====== End - Electronics ======-->


                                        <!--====== Women ======-->
                                        <div class="mega-menu-content">

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="images/banners/banner-mega-1.jpg" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="images/banners/banner-mega-2.jpg" alt=""></a>
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

                                                            <a href="{{ route('shop.side_v2') }}">HOT CATEGORIES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Dresses</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Blouses & Shirts</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">T-shirts</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Rompers</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">INTIMATES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Bras</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Brief Sets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Bustiers &
                                                                Corsets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Panties</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">WEDDING & EVENTS</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Wedding Dresses</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Evening Dresses</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Prom Dresses</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Flower Dresses</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">BOTTOMS</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Skirts</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Shorts</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Leggings</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Jeans</a>
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

                                                            <a href="{{ route('shop.side_v2') }}">OUTWEAR</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Blazers</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Basics Jackets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Trench</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Leather & Suede</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">JACKETS</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Denim Jackets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Trucker Jackets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Windbreaker
                                                                Jackets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Leather Jackets</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">ACCESSORIES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Tech Accessories</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Headwear</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Baseball Caps</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Belts</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">OTHER ACCESSORIES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Bags</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Wallets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Watches</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Sunglasses</a>
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
                                                                src="images/banners/banner-mega-3.jpg" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="images/banners/banner-mega-4.jpg" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                        </div>
                                        <!--====== End - Women ======-->


                                        <!--====== Men ======-->
                                        <div class="mega-menu-content">

                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-4 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="images/banners/banner-mega-5.jpg" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="images/banners/banner-mega-6.jpg" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="images/banners/banner-mega-7.jpg" alt=""></a>
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

                                                            <a href="{{ route('shop.side_v2') }}">HOT SALE</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">T-Shirts</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Tank Tops</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Polo</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Shirts</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">OUTWEAR</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Hoodies</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Trench</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Parkas</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Sweaters</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">BOTTOMS</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Casual Pants</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Cargo Pants</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Jeans</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Shorts</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">UNDERWEAR</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Boxers</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Briefs</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Robes</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Socks</a>
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

                                                            <a href="{{ route('shop.side_v2') }}">JACKETS</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Denim Jackets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Trucker Jackets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Windbreaker
                                                                Jackets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Leather Jackets</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">SUNGLASSES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Pilot</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Wayfarer</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Square</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Round</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">ACCESSORIES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Eyewear Frames</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Scarves</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Hats</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Belts</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">

                                                            <a href="{{ route('shop.side_v2') }}">OTHER ACCESSORIES</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Bags</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Wallets</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Watches</a>
                                                        </li>
                                                        <li>

                                                            <a href="{{ route('shop.side_v2') }}">Tech Accessories</a>
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
                                                                src="images/banners/banner-mega-8.jpg" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">

                                                        <a class="u-d-block" href="{{ route('shop.side_v2') }}">

                                                            <img class="u-img-fluid u-d-block"
                                                                src="images/banners/banner-mega-9.jpg" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                        </div>
                                        <!--====== End - Men ======-->


                                        <!--====== No Sub Categories ======-->
                                        <div class="mega-menu-content">
                                            <h5>No Categories</h5>
                                        </div>
                                        <!--====== End - No Sub Categories ======-->


                                        <!--====== No Sub Categories ======-->
                                        <div class="mega-menu-content">
                                            <h5>No Categories</h5>
                                        </div>
                                        <!--====== End - No Sub Categories ======-->


                                        <!--====== No Sub Categories ======-->
                                        <div class="mega-menu-content">
                                            <h5>No Categories</h5>
                                        </div>
                                        <!--====== End - No Sub Categories ======-->


                                        <!--====== No Sub Categories ======-->
                                        <div class="mega-menu-content">
                                            <h5>No Categories</h5>
                                        </div>
                                        <!--====== End - No Sub Categories ======-->
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
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Home<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:118px">
                                            <li>

                                                <a href="{{ route('shop.index') }}">Home 1</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('shop.index2') }}">Home 2</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('shop.index3') }}">Home 3</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Account<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            <li>

                                                <a href="{{ route('login') }}">Signin / Already Registered</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('register') }}">Signup / Register</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('password.request') }}">Lost Password</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a href="{{ route('dashboard') }}">Dashboard<i
                                                class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            <li class="has-dropdown has-dropdown--ul-left-100">

                                                <a href="{{ route('dashboard') }}">Manage My Account<i
                                                        class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                                <!--====== Dropdown ======-->

                                                <span class="js-menu-toggle"></span>
                                                <ul style="width:180px">
                                                    <li>

                                                        <a href="{{ route('dash.EditProfile') }}">Edit Profile</a>
                                                    </li>
                                                    <li>

                                                        <a href="{{ route('dash.address_book') }}">Edit Address Book</a>
                                                    </li>
                                                    <li>

                                                        <a href="{{ route('dash.ManageOrder') }}">Manage Order</a>
                                                    </li>
                                                </ul>
                                                <!--====== End - Dropdown ======-->
                                            </li>
                                            <li>

                                                <a href="{{ route('dash.my_profile') }}">My Profile</a>
                                            </li>
                                            <li class="has-dropdown has-dropdown--ul-left-100">

                                                <a href="{{ route('dash.address_book') }}">Address Book<i
                                                        class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                                <!--====== Dropdown ======-->

                                                <span class="js-menu-toggle"></span>
                                                <ul style="width:180px">
                                                    <li>

                                                        <a href="{{ route('dash.AddressMakeDefault') }}">Address Make
                                                            Default</a>
                                                    </li>
                                                    <li>

                                                        <a href="{{ route('dash.AddressAdd') }}">Add New Address</a>
                                                    </li>
                                                    <li>

                                                        <a href="{{ route('dash.AddressEdit') }}">Edit Address Book</a>
                                                    </li>
                                                </ul>
                                                <!--====== End - Dropdown ======-->
                                            </li>
                                            <li>

                                                <a href="{{ route('dash.track_order') }}">Track Order</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('dash.my_order') }}">My Orders</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('dash.payment_option') }}">My Payment Options</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('dash.cancellation') }}">My Returns &
                                                    Cancellations</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Empty<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            <li>

                                                <a href="{{ route('empty.Search') }}">Empty Search</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('empty.Cart') }}">Empty Cart</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('empty.Wishlist') }}">Empty Wishlist</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Product Details<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            <li>

                                                <a href="{{ route('products.detail') }}">Product Details</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('products.DetailVariable') }}">Product Details
                                                    Variable</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('products.DetailAffiliate') }}">Product Details
                                                    Affiliate</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Shop Grid Layout<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            <li>

                                                <a href="{{ route('shop.GridLeft') }}">Shop Grid Left Sidebar</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('shop.GridRight') }}">Shop Grid Right Sidebar</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('shop.GridFull') }}">Shop Grid Full Width</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('shop.side_v2') }}">Shop Side Version 2</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Shop List Layout<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            <li>

                                                <a href="{{ route('shop.ListLeft') }}">Shop List Left Sidebar</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('shop.ListRight') }}">Shop List Right Sidebar</a>
                                            </li>
                                            <li>

                                                <a href="{{ route('shop.ListFull') }}">Shop List Full Width</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
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

                                        <a href="{{ route('blog.LeftSidebar') }}">Blog Left Sidebar</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('blog.RightSidebar') }}">Blog Right Sidebar</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('blog.SidebarNone') }}">Blog Sidebar None</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('blog.Masonry') }}">Blog Masonry</a>
                                    </li>
                                    <li>

                                        <a href="{{ route('blog.detail') }}">Blog Details</a>
                                    </li>
                                </ul>
                                <!--====== End - Dropdown ======-->
                            </li>
                            <li>

                                <a href="{{ route('shop.side_v2') }}">VALUE OF THE DAY</a>
                            </li>
                            <li>

                                <a href="{{ route('shop.side_v2') }}">GIFT CARDS</a>
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

                                    <!--====== Mini Product Container ======-->
                                    <div class="mini-product-container gl-scroll u-s-m-b-15">

                                        <!--====== Card for mini cart ======-->
                                        <div class="card-mini-product">
                                            <div class="mini-product">
                                                <div class="mini-product__image-wrapper">

                                                    <a class="mini-product__link" href="{{ route('products.detail') }}">

                                                        <img class="u-img-fluid"
                                                            src="images/product/electronic/product3.jpg" alt=""></a>
                                                </div>
                                                <div class="mini-product__info-wrapper">

                                                    <span class="mini-product__category">

                                                        <a href="{{ route('shop.side_v2') }}">Electronics</a></span>

                                                    <span class="mini-product__name">

                                                        <a href="{{ route('products.detail') }}">Yellow Wireless
                                                            Headphone</a></span>

                                                    <span class="mini-product__quantity">1 x</span>

                                                    <span class="mini-product__price">$8</span>
                                                </div>
                                            </div>

                                            <a class="mini-product__delete-link far fa-trash-alt"></a>
                                        </div>
                                        <!--====== End - Card for mini cart ======-->


                                        <!--====== Card for mini cart ======-->
                                        <div class="card-mini-product">
                                            <div class="mini-product">
                                                <div class="mini-product__image-wrapper">

                                                    <a class="mini-product__link" href="{{ route('products.detail') }}">

                                                        <img class="u-img-fluid"
                                                            src="images/product/electronic/product18.jpg" alt=""></a>
                                                </div>
                                                <div class="mini-product__info-wrapper">

                                                    <span class="mini-product__category">

                                                        <a href="{{ route('shop.side_v2') }}">Electronics</a></span>

                                                    <span class="mini-product__name">

                                                        <a href="{{ route('products.detail') }}">Nikon DSLR Camera
                                                            4k</a></span>

                                                    <span class="mini-product__quantity">1 x</span>

                                                    <span class="mini-product__price">$8</span>
                                                </div>
                                            </div>

                                            <a class="mini-product__delete-link far fa-trash-alt"></a>
                                        </div>
                                        <!--====== End - Card for mini cart ======-->


                                        <!--====== Card for mini cart ======-->
                                        <div class="card-mini-product">
                                            <div class="mini-product">
                                                <div class="mini-product__image-wrapper">

                                                    <a class="mini-product__link" href="{{ route('products.detail') }}">

                                                        <img class="u-img-fluid" src="images/product/women/product8.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="mini-product__info-wrapper">

                                                    <span class="mini-product__category">

                                                        <a href="{{ route('shop.side_v2') }}">Women Clothing</a></span>

                                                    <span class="mini-product__name">

                                                        <a href="{{ route('products.detail') }}">New Dress D Nice
                                                            Elegant</a></span>

                                                    <span class="mini-product__quantity">1 x</span>

                                                    <span class="mini-product__price">$8</span>
                                                </div>
                                            </div>

                                            <a class="mini-product__delete-link far fa-trash-alt"></a>
                                        </div>
                                        <!--====== End - Card for mini cart ======-->


                                        <!--====== Card for mini cart ======-->
                                        <div class="card-mini-product">
                                            <div class="mini-product">
                                                <div class="mini-product__image-wrapper">

                                                    <a class="mini-product__link" href="{{ route('products.detail') }}">

                                                        <img class="u-img-fluid" src="images/product/men/product8.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="mini-product__info-wrapper">

                                                    <span class="mini-product__category">

                                                        <a href="{{ route('shop.side_v2') }}">Men Clothing</a></span>

                                                    <span class="mini-product__name">

                                                        <a href="{{ route('products.detail') }}">New Fashion D Nice
                                                            Elegant</a></span>

                                                    <span class="mini-product__quantity">1 x</span>

                                                    <span class="mini-product__price">$8</span>
                                                </div>
                                            </div>

                                            <a class="mini-product__delete-link far fa-trash-alt"></a>
                                        </div>
                                        <!--====== End - Card for mini cart ======-->
                                    </div>
                                    <!--====== End - Mini Product Container ======-->


                                    <!--====== Mini Product Statistics ======-->
                                    <div class="mini-product-stat">
                                        <div class="mini-total">

                                            <span class="subtotal-text">SUBTOTAL</span>

                                            <span class="subtotal-value">$16</span>
                                        </div>
                                        <div class="mini-action">

                                            <a class="mini-link btn--e-brand-b-2" href="{{ route('checkout') }}">PROCEED
                                                TO
                                                CHECKOUT</a>

                                            <a class="mini-link btn--e-transparent-secondary-b-2"
                                                href="{{ route('cart') }}">VIEW
                                                CART</a>
                                        </div>
                                    </div>
                                    <!--====== End - Mini Product Statistics ======-->
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