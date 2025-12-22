@extends('layouts.app')
@section('title', 'Signup')

@section('content')
    <div class="app-content">

        <div class="u-s-p-y-60">
            <div class="section__content">
                <div class="container">
                    <div class="breadcrumb">
                        <ul class="breadcrumb__list">
                            <li class="has-separator"><a href="{{ route('shop.index') }}">Home</a></li>
                            <li class="is-marked">Signup</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="u-s-p-b-60">

            <div class="section__intro u-s-m-b-60">
                <div class="container">
                    <h1 class="section__heading u-c-secondary">CREATE AN ACCOUNT</h1>
                </div>
            </div>

            <div class="section__content">
                <div class="container">
                    <div class="row row--center">
                        <div class="col-lg-6 col-md-8 u-s-m-b-30">

                            <div class="l-f-o">
                                <div class="l-f-o__pad-box">

                                    <h1 class="gl-h1">PERSONAL INFORMATION</h1>

                                    <div id="reg-msg"></div>

                                    <form id="registerForm" class="l-f-o__form">
                                        @csrf

                                        <div class="u-s-m-b-30">
                                            <label class="gl-label">FIRST NAME *</label>
                                            <input class="input-text input-text--primary-style" type="text"
                                                id="reg-fname" placeholder="First Name">
                                        </div>

                                        <div class="u-s-m-b-30">
                                            <label class="gl-label">LAST NAME *</label>
                                            <input class="input-text input-text--primary-style" type="text"
                                                id="reg-lname" placeholder="Last Name">
                                        </div>

                                        <div class="u-s-m-b-30">
                                            <label class="gl-label">E-MAIL *</label>
                                            <input class="input-text input-text--primary-style" type="email"
                                                id="reg-email" placeholder="Enter E-mail">
                                        </div>

                                        <div class="u-s-m-b-30">
                                            <label class="gl-label">PASSWORD *</label>
                                            <input class="input-text input-text--primary-style" type="password"
                                                id="reg-password" placeholder="Enter Password">
                                        </div>

                                        <button class="btn btn--e-transparent-brand-b-2" type="submit">CREATE</button>
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

            const form = document.querySelector("#registerForm");
            if (!form) return;

            form.addEventListener("submit", async function(e) {
                e.preventDefault();

                let fname = document.querySelector("#reg-fname").value.trim();
                let lname = document.querySelector("#reg-lname").value.trim();
                let email = document.querySelector("#reg-email").value.trim();
                let password = document.querySelector("#reg-password").value.trim();
                let msg = document.getElementById("reg-msg");

                // Validate
                if (!fname || !lname || !email || !password) {
                    msg.innerHTML =
                        "<div class='alert alert-danger'>Vui lòng nhập đầy đủ thông tin.</div>";
                    return;
                }

                let fullname = fname + " " + lname;

                let res = await fetch("http://127.0.0.1:8001/auth/register", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        fullname,
                        email,
                        password
                    }),
                    credentials: "include"
                });

                let data = await res.json();

                if (data.ok) {
                    msg.innerHTML = "<div class='alert alert-success'>Registration successful!</div>";
                    setTimeout(() => window.location.href = "{{ route('login') }}", 1000);
                } else {
                    msg.innerHTML = "<div class='alert alert-danger'>" + data.message + "</div>";
                }
            });

        });
    </script>

@endsection
