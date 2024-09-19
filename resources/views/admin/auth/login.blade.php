@extends('admin.layouts.guest.master')

@section('content')
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <img src="{{ asset(config('custom.images.logo')) }}" width="200" alt="">
            </div>
            <x-form :action="route('admin.login.post')" class="card card-md" type="post" :validate="true">
                <div class="card-body">
                <h2 class="card-title text-center mb-4">{{ __('Đăng nhập') }}</h2>
                <div class="mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <x-input-email name="email" :required="true" />
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Mật khẩu') }}</label>
                    <x-input-password name="password" :required="true" />
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Đăng nhập') }}</button>
                </div>
                </div>
            </x-form>
        </div>
    </div>
@endsection