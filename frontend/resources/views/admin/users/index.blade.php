{{-- resources/views/admin/users/index.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Quản Lý Người Dùng')

@section('admin_content')

<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
        <div class="alert alert-success u-s-m-b-20">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger u-s-m-b-20">
            {{ session('error') }}
        </div>
        @endif

        {{-- TITLE --}}
        <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">
            Danh Sách Người Dùng
        </h1>

        {{-- SEARCH --}}
        <div class="u-s-m-b-30 d-flex justify-content-start">
            <form class="main-form" method="GET" style="width: 30%;">
                <input class="input-text input-text--border-radius input-text--style-1" type="text" name="search"
                    value="{{ request('search') }}" placeholder="Tìm kiếm theo tên hoặc email...">
                <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
            </form>
        </div>

        {{-- TOTAL (không tính admin) --}}
        <h2 class="dash__h2 u-s-p-xy-20">
            {{ collect($users)->where('role', '!=', 'admin')->count() }}
            Người Dùng Đã Đăng Ký
        </h2>

        {{-- TABLE --}}
        <div class="dash__table-wrap gl-scroll">
            <table class="dash__table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Ngày đăng ký</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @if(empty($users))
                    <tr>
                        <td colspan="6" class="text-center">
                            Không có người dùng nào
                        </td>
                    </tr>
                    @else
                    @foreach($users as $user)
                    <tr class="{{ $user['role'] === 'block' ? 'user-blocked' : '' }}">
                        <td>{{ $user['id'] }}</td>

                        {{-- TÊN --}}
                        <td>
                            @if(request('edit_id') == $user['id'])
                            <form method="POST" action="{{ route('admin.users.updateName', $user['id']) }}"
                                style="display:flex; gap:6px; align-items:center;">
                                @csrf
                                @method('PUT')

                                <input type="text" name="fullname" value="{{ $user['fullname'] }}"
                                    class="input-text input-text--style-1" style="width:140px" required>

                                <button type="submit" class="btn btn--e-brand btn--small">
                                    LƯU
                                </button>

                                <a href="{{ route('admin.users.index') }}"
                                    class="btn btn--e-transparent-brand btn--small">
                                    HỦY
                                </a>
                            </form>
                            @else
                            {{ $user['fullname'] }}
                            @endif
                        </td>

                        {{-- EMAIL --}}
                        <td>{{ $user['email'] }}</td>

                        {{-- ROLE --}}
                        <td>
                            @if($user['role'] === 'admin')
                            <span class="gl-label u-c-brand">Admin</span>
                            @elseif($user['role'] === 'block')
                            <span class="gl-label u-c-danger">Bị khóa</span>
                            @else
                            <span class="gl-label u-c-secondary">Khách hàng</span>
                            @endif
                        </td>

                        {{-- CREATED --}}
                        <td>
                            {{ isset($user['created_at'])
                                ? \Carbon\Carbon::parse($user['created_at'])->format('d/m/Y')
                                : '-' }}
                        </td>

                        {{-- ACTION --}}
                        <td>
                            <div class="dash__link dash__link--brand">

                                {{-- SỬA --}}
                                <!-- @if(request('edit_id') != $user['id'])
                                <a href="{{ route('admin.users.index', ['edit_id' => $user['id']]) }}"
                                    class="u-c-secondary">
                                    SỬA
                                </a>
                                @endif -->

                                {{-- BLOCK / UNBLOCK --}}
                                @if($user['role'] === 'block')

                                <form method="POST" action="{{ route('admin.users.unblock', $user['id']) }}"
                                    style="display:inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="link-button"
                                        onclick="return confirm('Mở khóa tài khoản này?')">
                                        MỞ KHÓA
                                    </button>
                                </form>

                                <div class="u-s-m-t-5 u-c-danger" style="font-size:12px;">
                                    Tài khoản này hiện không thể đăng nhập
                                </div>

                                @elseif($user['role'] !== 'admin')

                                <form method="POST" action="{{ route('admin.users.block', $user['id']) }}"
                                    style="display:inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="link-button u-c-danger"
                                        onclick="return confirm('Tài khoản sẽ không thể đăng nhập. Bạn chắc chắn?')">
                                        KHÓA
                                    </button>
                                </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>

            </table>
        </div>
    </div>
</div>

{{-- UX STYLE --}}
<style>
    .user-blocked {
        opacity: 0.6;
        background-color: #fff5f5;
    }

    .link-button {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        font-weight: 500;
    }
</style>

@endsection