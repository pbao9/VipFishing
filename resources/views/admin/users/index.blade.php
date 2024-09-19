@extends('admin.layouts.master')

@push('libs-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.bootstrap5.min.css">
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h2 class="mb-0">{{ __('listUser') }}</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive position-relative">
                        <x-admin.partials.toggle-column-datatable />
                        {{ $dataTable->table(['class' => 'table table-bordered', 'style' => 'min-width: 900px;'], true) }}
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

    @include('admin.users.scripts.datatable')
@endpush
