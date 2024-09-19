@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">{{ __('Dashboard') }}</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}"
                                        class="text-muted">{{ __('Slider') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Sửa slider item') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.slider.item.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$sliderItem->id" />
                <x-input type="hidden" name="slider_id" :value="$sliderItem->slider_id" />
                <div class="row justify-content-center">
                    @include('admin.sliders.items.forms.edit-left')
                    @include('admin.sliders.items.forms.edit-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
    @include('ckfinder::setup')
@endpush