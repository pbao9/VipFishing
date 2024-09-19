@extends('admin.layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    {{-- <h2 class="mb-0">{{ __('listVariationFishs') }}  -  {{ $fish->name }} - {{ $fish->provinces->name }}</h2> --}}
                    <h2 class="mb-0">{{ __('listVariationFishs') }} - <x-link class="text-primary" :href="route('admin.fishs.edit', $fish->id)" :title="$fish->name .' - '. $fish->provinces->name" /></h2>

                            <x-link :href="route('admin.fishs.item.create',$fish['id'])" class="btn btn-primary"><i class="ti ti-plus"></i>{{ __('Thêm Mật độ cá') }}</x-link>
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

@include('admin.variationFishs.scripts.datatable')

@endpush