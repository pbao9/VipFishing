@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Profile') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <x-form :action="route('admin.profile.update')" type="put" enctype="multipart/form-data" :validate="true">
                    <div class="card">
                        <div class="card-header justify-content-center">
                            <h2 class="mb-0">{{ __('My profile') }}</h2>
                        </div>
                        <div class="card-body">
                            <!-- fullname -->
                            <div class="mb-3">
                                <label class="control-label">{{ __('Họ và tên') }}:</label>
                                <x-input name="fullname" :value="$auth->fullname" :required="true" placeholder="{{ __('Họ và tên') }}"/>
                            </div>
                            <!-- phone -->
                            <div class="mb-3">
                                <label class="control-label">{{ __('Số điện thoại') }}:</label>
                                <x-input-phone name="phone" :value="$auth->phone" :required="true" />
                            </div>
                            <!-- address -->
                            <div class="mb-3">
                                <label class="control-label">{{ __('Địa chỉ') }}:</label>
                                <x-input name="address" :value="$auth->address" placeholder="{{ __('Địa chỉ') }}"/>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-center">
                                <x-button.submit :title="__('Cập nhật')" />
                            </div>
                        </div>
                    </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection
