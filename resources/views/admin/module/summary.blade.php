@extends('admin.layouts.master')

@push('libs-css')
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Danh sách nghiệm thu') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h2 class="mb-0">{{ __('Danh sách nghiệm thu') }}</h2>
                </div>
                <div class="card-body">
					<table class="table table-bordered table-hover">
					  <thead class="thead-dark">
						<tr>
						  <th scope="col" class="col-4">Module & Chức năng xây dựng</th>
						  <th scope="col" class="col-8">Mô tả</th>
						</tr>
					  </thead>
					  <tbody>
						
						@foreach($listmodules as $moduleID => $module )
						<tr>
						  <td><b>Module</b>: {{ $module['name'] }} <br /><br />
							<span @class([
								'badge',
								'bg-red-lt' => \App\Enums\Module\ModuleStatus::ChuaXong == $module['status'],
								'bg-blue-lt' => \App\Enums\Module\ModuleStatus::DaXong == $module['status'],
								'bg-green-lt' => \App\Enums\Module\ModuleStatus::DaDuyet == $module['status'],
							])>{{ \App\Enums\Module\ModuleStatus::getDescription($module['status']) }}</span>
							
						  <ol class="modulePermissionsList">
							@foreach($module['permissions'] as $permission)
							<li>{{ $permission->title }}</li>
							@endforeach
						  </ol>
						  
						  </td>
						  <td>{!! $module['description'] !!}</td>
						</tr>
						@endforeach	
						
					  </tbody>
					</table>
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

@endpush
