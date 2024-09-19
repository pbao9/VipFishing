@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-muted">{{ __('Dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.attribute.index') }}"
                                        class="text-muted">{{ __('Các thuộc tính') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Thêm thuộc tính') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.attribute.variation.store')" type="post" :validate="true">
                <x-input type="hidden" name="attribute_id" :value="$attribute->id" />
                <div class="row justify-content-center">
                    @include('admin.variations.forms.create-left')
                    @include('admin.variations.forms.create-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection

