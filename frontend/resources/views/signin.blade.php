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

                                    <form id="loginForm" class="l-f-o__form" method="POST"
                                        action="{{ route('auth.login') }}">
                                        @csrf

                                        <div class="u-s-m-b-30">
                                            <label class="gl-label" for="login-email">E-MAIL *</label>
                                            <input class="input-text input-text--primary-style" type="email"
                                                id="login-email" name="email" required placeholder="Enter E-mail">
                                        </div>

                                        <div class="u-s-m-b-30">
                                            <label class="gl-label" for="login-password">PASSWORD *</label>
                                            <input class="input-text input-text--primary-style" type="password"
                                                id="login-password" name="password" required placeholder="Enter Password">
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

    <script></script>

@endsection
