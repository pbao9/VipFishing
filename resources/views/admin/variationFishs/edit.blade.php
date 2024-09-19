@extends('admin.layouts.master')

@push('libs-css')
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.fishs.item.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$variationFishs->id" />
                <x-input type="hidden" name="fish_id" :value="$variationFishs->fish_id" />
                <div class="row justify-content-center">
                    @include('admin.variationFishs.forms.edit-left')
                    @include('admin.variationFishs.forms.edit-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')
    <script src="{{ asset('public/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/libs/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('/public/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/public/libs/select2/dist/js/i18n/vi.js') }}"></script>
    @include('ckfinder::setup')
@endpush


@push('custom-js')
    @include('admin.variationFishs.scripts.scripts')
@endpush
