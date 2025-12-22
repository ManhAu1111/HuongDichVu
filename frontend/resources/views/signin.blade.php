@extends('layouts.app')
@section('title', 'Signin')

@section('content')
    <div class="app-content">

        <div class="u-s-p-y-60">
            <div class="section__content">
                <div class="container">
                    <div class="breadcrumb">
                        <div class="breadcrumb__wrap">
                            <ul class="breadcrumb__list">
                                <li class="has-separator"><a href="{{ route('shop.index') }}">Home</a></li>
                                <li class="is-marked">Signin</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="u-s-p-b-60">

            <div class="section__intro u-s-m-b-60">
                <div class="container">
                    <h1 class="section__heading u-c-secondary">ALREADY REGISTERED?</h1>
                </div>
            </div>
            <div class="section__content">
                <div class="container">
                    <div class="row row--center">
                        <div class="col-lg-6 col-md-8 u-s-m-b-30">

                            <div class="l-f-o">
                                <div class="l-f-o__pad-box">

                                    <h1 class="gl-h1">SIGNIN</h1>
                                    <div id="login-msg"></div>

                                    <form id="loginForm" class="l-f-o__form" @csrf <div class="u-s-m-b-30">
                                        <label class="gl-label" for="login-email">E-MAIL *</label>
                                        <input class="input-text input-text--primary-style" type="email" id="login-email"
                                            name="email" required placeholder="Enter E-mail">
                                </div>

                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="login-password">PASSWORD *</label>
                                    <input class="input-text input-text--primary-style" type="password" id="login-password"
                                        name="password" required placeholder="Enter Password">
                                </div>

                                <div id="login-msg"></div>

                                <div class="u-s-m-b-30">
                                    <button class="btn btn--e-transparent-brand-b-2" type="submit">
                                        LOGIN
                                    </button>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const form = document.getElementById("loginForm");
            const msg = document.getElementById("login-msg");

            form.addEventListener("submit", async function(e) {
                e.preventDefault();

                const email = document.getElementById("login-email").value.trim();
                const password = document.getElementById("login-password").value.trim();

                msg.innerHTML = "Đang đăng nhập...";

                try {
                    const res = await fetch("http://127.0.0.1:8001/auth/login", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            email,
                            password
                        }),
                    });

                    const data = await res.json();

                    if (!data.ok) {
                        msg.innerHTML = `<p style='color:red'>${data.message}</p>`;
                        return;
                    }

                    // Lưu token vào cookie
                    document.cookie = "auth_token=" + data.token + "; path=/;";

                    // Điều hướng sau khi login thành công
                    if (data.user.role === "admin") {
                        window.location.href = "/admin";
                    } else {
                        window.location.href = "/dashboard";
                    }


                } catch (err) {
                    msg.innerHTML = "<p style='color:red'>Lỗi kết nối tới Auth-service</p>";
                }
            });

        });
    </script>



@endsection
