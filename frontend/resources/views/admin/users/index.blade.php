{{-- resources/views/admin/users/index.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Quản Lý Người Dùng')

@section('admin_content')

<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Danh Sách Người Dùng</h1>

        <div class="u-s-m-b-30 d-flex justify-content-end">
            <form class="main-form" method="GET" style="width: 50%;">
                <label for="admin-user-search"></label>
                <input class="input-text input-text--border-radius input-text--style-1"
                       type="text" id="admin-user-search" name="search"
                       value="{{ request('search') }}" placeholder="Tìm kiếm theo email/tên...">
                <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
            </form>
        </div>

        <h2 class="dash__h2 u-s-p-xy-20">50 Người Dùng Đã Đăng Ký</h2>
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
                    <tr>
                        <td>1</td>
                        <td>Admin Chính</td>
                        <td>admin@ludus.com</td>
                        <td><span class="gl-label u-c-brand">Admin</span></td>
                        <td>01/01/2025</td>
                        <td>
                            <div class="dash__link dash__link--brand">
                                <a href="#">SỬA</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>John Doe</td>
                        <td>johndoe@domain.com</td>
                        <td><span class="gl-label u-c-secondary">Khách hàng</span></td>
                        <td>15/11/2025</td>
                        <td>
                            <div class="dash__link dash__link--brand">
                                <a href="#">SỬA</a> |
                                <a href="#" onclick="confirm('Xác nhận khóa tài khoản?')">KHÓA</a>
                            </div>
                        </td>
                    </tr>
                    {{-- Thêm các dòng người dùng khác tại đây --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
