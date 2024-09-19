@extends('admin.layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="d-flex gap-2 align-items-center fw-bold">
                        <h2 class="mb-0">{{ __('listLakeChild') }} - Thuộc: </h2>
                        <x-link :href="route('admin.lakes.edit', $lake->id)" :title="$lake->name" class="fs-2 fw-bold" />
                    </div>

                    <x-link :href="route('admin.lakes.item.create', $lake->id)" class="btn btn-primary"><i
                            class="ti ti-plus"></i>{{ __('addLakeChild') }}</x-link>
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

    @include('admin.lakes.items.scripts.datatable')
@endpush
