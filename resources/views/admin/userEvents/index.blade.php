@extends('admin.layouts.master')

@push('libs-css')
@endpush

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header justify-content-between">
                @if (isset($event))
                    <span><h2 class="mb-0">{{ __('listUserEvent') }}</h2>
                    <x-link :href="route('admin.events.edit', $event->id)" class="fs-3 fw-bold" target="_blank" :title="$event->title"/> - 
                    <x-link :href="route('admin.lakes.item.edit', $event->lakechild->id)" class="fs-3 fw-bold" target="_blank" :title="$event->lakechild->name" /></span>
                @else
                    <h2 class="mb-0">{{ __('listUserEvent') }}</h2>
                @endif
                {{--<x-link :href="route('admin.userEvents.create')" class="btn btn-primary"><i
                        class="ti ti-plus"></i>{{ __('Thêm UserEvents') }}</x-link>--}}
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

    @include('admin.userEvents.scripts.datatable')

@endpush