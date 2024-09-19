@extends('admin.layouts.master')

@push('libs-css')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}"
                                        class="text-muted">{{ __('Slider') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Danh sách slider item') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h2 class="mb-0">{{ __('Danh sách slider item') }} - <x-link class="text-primary" :href="route('admin.slider.edit', $slider->id)" :title="$slider->name" /></h2>
                    <x-link :href="route('admin.slider.item.create', $slider->id)" class="btn btn-primary"><i class="ti ti-plus"></i>{{ __('Thêm slider item') }}</x-link>
                </div>
                <div class="card-body">
                    <div class="table-responsive position-relative">
                        <x-admin.partials.toggle-column-datatable />
                        {{$dataTable->table(['class' => 'table table-bordered', 'style' => 'min-width: 900px;'], true)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('libs-js')
<!-- button in datatable -->
<script src="{{ asset('/public/vendor/datatables/buttons.server-side.js') }}"></script>
@endpush

@push('custom-js')

{{ $dataTable->scripts() }}

@include('admin.sliders.items.scripts.datatable')

@endpush
