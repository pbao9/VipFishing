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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Sửa Admin') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.admin.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$admin->id" />
                <div class="row justify-content-center">
                    @include('admin.admins.forms.edit-left')
                    @include('admin.admins.forms.edit-right')
                </div>
            </x-form>
        </div>
    </div>
@endsection
