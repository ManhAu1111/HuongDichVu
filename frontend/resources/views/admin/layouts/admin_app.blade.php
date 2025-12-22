{{-- resources/views/admin/layouts/admin_app.blade.php --}}

{{-- 1. Kế thừa file layout chính --}}
@extends('layouts.app')

{{-- 2. Đặt tiêu đề riêng --}}
@section('title', 'Admin - ' . (isset($__env) && $__env->yieldContent('admin_title') ? $__env->yieldContent('admin_title') : 'Dashboard'))


{{-- 3. Bắt đầu phần nội dung --}}
@section('content')
    <div class="app-content">

        <div class="u-s-p-y-60">
            <div class="section__content">
                <div class="container">
                    <div class="breadcrumb">
                        <div class="breadcrumb__wrap">
                            <ul class="breadcrumb__list">
                                <li class="has-separator">
                                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                                </li>
                                <li class="is-marked">
                                    <a href="#">@yield('admin_title')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="u-s-p-b-60">
            <div class="section__content">
                <div class="dash">
                    <div class="container">
                        <div class="row">
                            {{-- Sidebar Menu Admin (Cột 3) --}}
                            <div class="col-lg-3 col-md-12">
                                @include('admin.layouts.sidebar')
                            </div>

                            {{-- Nội dung chính của trang Admin (Cột 9) --}}
                            <div class="col-lg-9 col-md-12">
                                @yield('admin_content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
@endsection
{{-- 4. Kết thúc phần nội dung --}}
