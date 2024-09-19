@extends('admin.layouts.master')
@push('libs-css')
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
@endpush
@push('custom-css')
    <style>
        .product-variations{
            list-style: none;
        }
        .product-variations li{
            padding: 5px;
            cursor: default;
        }
        .product-variations li:hover{
            background-color: gainsboro;
        }
        .remove-item-product:hover{
            background-color:#f3dbdb;
        }
    </style>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Sửa đơn hàng') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <x-form id="formOrder" :action="route('admin.order.update')" type="put" :validate="true">
                <x-input type="hidden" name="order[id]" :value="$order->id" />
                <div class="row justify-content-center">
                    @include('admin.orders.forms.edit-left')
                    @include('admin.orders.forms.edit-right')
                </div>
            </x-form>
        </div>
    </div>
    @include('admin.orders.partials.modal-add-products')
@endsection

@push('libs-js')
<script src="{{ asset('/public/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('/public/libs/select2/dist/js/i18n/vi.js') }}"></script>
<script src="{{ asset('/public/libs/jquery-throttle-debounce/jquery.ba-throttle-debounce.min.js') }}"></script>
@endpush
@push('custom-js')

@include('admin.orders.scripts.scripts')

@endpush


