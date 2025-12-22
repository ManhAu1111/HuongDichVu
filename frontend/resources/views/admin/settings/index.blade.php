{{-- resources/views/admin/settings/index.blade.php --}}
@extends('admin.layouts.admin_app')

@section('admin_title', 'Cài Đặt Hệ Thống')

@section('admin_content')

<div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
    <div class="dash__pad-2">
        <h1 class="dash__h1 u-s-m-b-14 u-c-secondary">Cài Đặt Chung</h1>
        <span class="dash__text u-s-m-b-30">Cập nhật thông tin và cấu hình cơ bản của website.</span>

        <form class="l-f-o__form" method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')

            <div class="u-s-m-b-30">
                <label class="gl-label" for="site-name">TÊN WEBSITE *</label>
                <input class="input-text input-text--primary-style" type="text" id="site-name" name="site_name" placeholder="Ludus Reshop" value="Ludus Reshop" required>
            </div>

            <div class="u-s-m-b-30">
                <label class="gl-label" for="contact-email">EMAIL LIÊN HỆ *</label>
                <input class="input-text input-text--primary-style" type="email" id="contact-email" name="contact_email" placeholder="contact@domain.com" value="contact@domain.com" required>
            </div>

            <div class="u-s-m-b-30">
                <label class="gl-label" for="shipping-cost">PHÍ VẬN CHUYỂN MẶC ĐỊNH ($)</label>
                <input class="input-text input-text--primary-style" type="number" id="shipping-cost" name="shipping_cost" placeholder="4.00" value="4.00" required>
            </div>

            <h2 class="dash__h2 u-s-m-t-20 u-s-m-b-8">MẠNG XÃ HỘI</h2>
            <div class="u-s-m-b-30">
                <label class="gl-label" for="facebook-link">FACEBOOK URL</label>
                <input class="input-text input-text--primary-style" type="url" id="facebook-link" name="facebook_link" value="http://facebook.com/ludus">
            </div>

            <div class="u-s-m-b-30">
                <button class="btn btn--e-brand-b-2" type="submit">LƯU CÀI ĐẶT</button>
            </div>
        </form>
    </div>
</div>
@endsection
