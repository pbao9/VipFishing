@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted">{{ __('Dashboard') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Đổi mật khẩu') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <x-form :action="route('admin.password.update')" type="put" enctype="multipart/form-data" :validate="true">
                    <div class="card">
                        <div class="card-header justify-content-center">
                            <h2 class="mb-0">{{ __('Đổi mật khẩu') }}</h2>
                        </div>
                        <div class="card-body">
                            <!-- password old -->
                            <div class="mb-3">
                                <label class="control-label">{{ __('Mật khẩu cũ') }}:</label>
                                <x-input-password name="old_password" :required="true"/>
                            </div>
                            <!-- new password -->
                            <div class="mb-3">
                                <label class="control-label">{{ __('Mật khẩu mới') }}:</label>
                                <x-input-password name="password" :required="true"/>
                            </div>
                            <!-- new password confirmation-->
                            <div class="mb-3">
                                <label class="control-label">{{ __('Xác nhận mật khẩu') }}:</label>
                                <x-input-password name="password_confirmation" :required="true" data-parsley-equalto="input[name='password']" data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}"/>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-center">
                                <x-button.submit :title="__('Đổi mật khẩu')" />
                            </div>
                        </div>
                    </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection
