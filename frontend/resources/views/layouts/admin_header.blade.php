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

                <a class="main-logo">
                    <img src="{{ asset('images/logo/logo-1.png') }}" alt=""></a>
                <!--====== End - Main Logo ======-->


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
                                    //location.reload(); // reload cả trang
                                });
                        });
                    });

                });
        }

        loadMiniCart(); // chạy lần đầu
    });
</script>
