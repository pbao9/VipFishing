@extends('admin.layouts.master')
@push('libs-css')
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
@endpush
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.lakes.item.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$lakechilds->id" />
                <x-input type="hidden" name="lake_id" :value="$lakechilds->lake_id" />
                <div class="row justify-content-center">
                    @include('admin.lakes.items.forms.edit-left')
                    @include('admin.lakes.items.forms.edit-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
    <script src="{{ asset('public/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/public/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/public/libs/select2/dist/js/i18n/vi.js') }}"></script>
    <script src="{{ asset('public/libs/ckeditor/adapters/jquery.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@push('custom-js')
    @include('admin.lakes.items.scripts.scripts')
    @include('admin.lakes.items.scripts.calendar')
@endpush

<style>
    .selected-date {
        background-color: #8a97ab;
        color: white;
    }

    .fc-toolbar-title,
    .fc-daygrid-day-number,
    .fc-daygrid-day-top,
    .fc-daygrid-day-bottom,
    .fc-event-title {
        text-transform: uppercase;
    }

    .fc-col-header-cell,
    .fc-col-header-cell-cushion {
        text-transform: uppercase;
    }
</style>
