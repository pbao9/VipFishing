@extends('admin.layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="d-flex gap-2 align-items-center fw-bold">
                        <h2 class="mb-0">{{ __('listRating') }} - </h2>
                        <x-link :href="route('admin.lakes.item.edit', $lakeChild->id)" :title="$lakeChild->name" class="fs-2 fw-bold"/>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive position-relative">
                        <x-admin.partials.toggle-column-datatable/>
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
    @include('admin.lakeChildRatings.scripts.datatable')
@endpush
