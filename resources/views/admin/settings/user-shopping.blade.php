@extends('admin.layouts.master')

@push('libs-css')

@endpush
@push('custom-css')
    <style>
        .wrap-loop-input .add-image-ckfinder{
            max-width: 300px;
            display: block;
        }
    </style>
@endpush
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">{{ __('Dashboard') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Thành viên mua hàng') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.setting.update')" type="put" :validate="true">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="row">
                            @foreach ($setting_groups as $key => $settings)
                                <div class="col-12 col-md-6">
                                    @include('admin.settings.forms.edit-left', [
                                        'settings' => $settings,
                                        'title' => App\Enums\Setting\SettingGroup::getDescription($key)
                                    ])
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @include('admin.settings.forms.edit-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')

@endpush

@push('custom-js')

@endpush
