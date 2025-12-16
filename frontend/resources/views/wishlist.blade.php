{{-- Kế thừa layout chính --}}
@extends('layouts.app')

@section('title', 'Ludus - Wishlist')

@section('content')
    <div class="app-content">

        <!--====== Breadcrumb ======-->
        <div class="u-s-p-y-60">
            <div class="section__content">
                <div class="container">
                    <div class="breadcrumb">
                        <div class="breadcrumb__wrap">
                            <ul class="breadcrumb__list">
                                <li class="has-separator">
                                    <a href="{{ route('shop.index') }}">Home</a>
                                </li>
                                <li class="is-marked">
                                    <a href="{{ route('wishlist') }}">Wishlist</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--====== Wishlist Section ======-->
        <div class="u-s-p-b-60">
            <div class="section__intro u-s-m-b-60">
                <div class="container">
                    <h1 class="section__heading u-c-secondary">Wishlist</h1>
                </div>
            </div>

            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            {{-- Wishlist items render ở đây --}}
                            <div id="wishlist-container"></div>

                        </div>

                        <div class="col-lg-12">
                            <div class="route-box">
                                <div class="route-box__g">
                                    <a class="route-box__link" href="{{ route('shop.side_v2') }}">
                                        <i class="fas fa-long-arrow-alt-left"></i>
                                        <span>CONTINUE SHOPPING</span>
                                    </a>
                                </div>
                                <a class="route-box__link" href="#" id="clear-wishlist-btn">
                                    <i class="fas fa-trash"></i>
                                    <span>CLEAR WISHLIST</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        const API_WISHLIST = 'http://127.0.0.1:8003/wishlist';

        function getCookie(name) {
            const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
            return match ? match[2] : null;
        }

        const TOKEN = getCookie('auth_token');

        document.addEventListener('DOMContentLoaded', loadWishlist);

        async function loadWishlist() {
            if (!TOKEN) {
                window.location.href = "{{ route('login') }}";
                return;
            }

            const res = await fetch(API_WISHLIST, {
                headers: {
                    'Authorization': 'Bearer ' + TOKEN
                }
            });

            const json = await res.json();

            if (!json.data || json.data.length === 0) {
                window.location.href = "{{ route('empty.Wishlist') }}";
                return;
            }

            const container = document.getElementById('wishlist-container');

            container.innerHTML = json.data.map(item => `
        <div class="w-r u-s-m-b-30">
            <div class="w-r__container">
                <div class="w-r__wrap-1">
                    <div class="w-r__img-wrap">
                        <img class="u-img-fluid" src="${item.thumbnail}" alt="">
                    </div>
                    <div class="w-r__info">
                        <span class="w-r__name">
                            <a href="/product/${item.product_id}">${item.name}</a>
                        </span>
                        <span class="w-r__price">${Number(item.price).toLocaleString()}đ</span>
                    </div>
                </div>
            </div>
        </div>
    `).join('');
        }

        document.getElementById('clear-wishlist-btn')?.addEventListener('click', async function(e) {
            e.preventDefault();

            if (!confirm('Bạn có chắc muốn xoá toàn bộ wishlist không?')) return;

            const TOKEN = getCookie('auth_token');
            if (!TOKEN) {
                window.location.href = "{{ route('login') }}";
                return;
            }

            try {
                // 1. Lấy toàn bộ wishlist
                const res = await fetch(API_WISHLIST, {
                    headers: {
                        'Authorization': 'Bearer ' + TOKEN
                    }
                });

                const json = await res.json();
                if (!json.data || json.data.length === 0) {
                    window.location.href = "{{ route('empty.Wishlist') }}";
                    return;
                }

                // 2. Xoá từng item
                await Promise.all(
                    json.data.map(item =>
                        fetch(`${API_WISHLIST}/${item.product_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Authorization': 'Bearer ' + TOKEN
                            }
                        })
                    )
                );

                // 3. Redirect sang empty wishlist
                window.location.href = "{{ route('empty.Wishlist') }}";

            } catch (err) {
                console.error(err);
                alert('Không thể xoá wishlist, thử lại sau!');
            }
        });
    </script>

@endsection