@extends('admin.layouts.master')
@push('libs-css')
    {{-- <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}"> --}}
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Thêm danh mục') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.category.store')" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('admin.categories.forms.create-left')
                    @include('admin.categories.forms.create-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
<!-- ckfinder js -->
@include('ckfinder::setup')
    {{-- <script src="{{ asset('/public/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/public/libs/select2/dist/js/i18n/vi.js') }}"></script> --}}
@endpush

@push('custom-js')
    {{-- <script>
        $('.select2-bs5').select2({
            language: "vi",
            theme: 'bootstrap-5'
        });
    </script> --}}
@endpush
