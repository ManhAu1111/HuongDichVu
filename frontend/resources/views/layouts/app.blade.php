<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon">
    <!--====== Google Font ======-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
    <!--====== Bootstrap CSS ======-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    <!--====== Vendor-Plugins ======-->
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <!--====== Utility-Spacing ======-->
    <link rel="stylesheet" href="{{ asset('css/utility.css') }}">
    <!--====== App ======-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!--====== three.js ======-->
    {{-- <script src="https://cdn.jsdelivr.net/gh/mrdoob/three.js@r140/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mrdoob/three.js@r140/examples/js/controls/OrbitControls.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mrdoob/three.js@r140/examples/js/loaders/GLTFLoader.js"></script> --}}
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    {{-- Nếu KHÔNG dùng Laravel Mix, giữ nguyên dòng sau --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</head>
<body>

    <div id="app"> {{-- Thẻ #app bao bọc header, content, footer --}}

        {{-- SỬA LẠI ĐƯỜNG DẪN INCLUDE CHO ĐÚNG --}}
        @include('layouts.header')

        {{-- Nội dung của trang con (như detail.blade.php) sẽ vào đây --}}
        @yield('content')

        {{-- SỬA LẠI ĐƯỜNG DẪN INCLUDE CHO ĐÚNG --}}
        @include('layouts.footer')

    </div>
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')
    </script>

    <script src="https://www.google-analytics.com/analytics.js" async defer></script>

    <!--====== Vendor Js ======-->
    <script src="{{ asset('js/vendor.js') }}"></script>

    <!--====== jQuery Shopnav plugin ======-->
    <script src="{{ asset('js/jquery.shopnav.js') }}"></script>

    <!--====== App ======-->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <noscript>
        <div class="app-setting">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="app-setting__wrap">
                            <h1 class="app-setting__h1">JavaScript is disabled in your browser.</h1>
                            <span class="app-setting__text">Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </noscript>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
