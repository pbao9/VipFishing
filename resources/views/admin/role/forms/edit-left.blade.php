<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin vai trò') }}</h2>
           
        </div>
        <div class="row card-body">
            <!-- tile -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên vai trò') }}:</label>
                    <x-input name="title" :value="$role->title" :required="true"
                        placeholder="{{ __('Ví dụ: Kế toán') }}" />
                </div>
            </div>
			
			<!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Slug') }}:</label>
                    <x-input name="name" :value="$role->name" :required="true"
                        placeholder="{{ __('Viết liền không khoảng cách, không dấu dựa theo tên vai trò. Ví dụ: ketoan') }}" />
                </div>
            </div>
			
			
			<!-- guard_name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Vai trò của ( Guard Name )') }}:</label>
                    <x-select name="guard_name" :required="true">
						<x-select-option :option="$role->guard_name" value="admin" title="Admin" />
						<x-select-option :option="$role->guard_name" value="web" title="Thành viên trên Web" />
					</x-select>
                </div>
            </div>
       
			<hr />
			<!-- permissions -->
			<div class="col-12">
                <div class="mb-3">
                    <label class="control-label givePermissionsLabel">{{ __('Phân quyền') }}:</label><br />
					<div id="checkAllPermissionsDiv"><input type="checkbox" id="checkAllPermissions"> Chọn tất cả</div>
					
					<div class="row">
						@foreach($listPermissionsInAllModules as $moduleID => $permissionsListOfTheModule)
							<div class="col-4">
								<div class="mevivuModuleBox">
									<input type="checkbox" id="{{ $moduleID }}" class="checkboxPermission clickSelectAllPermissionInModule"> <strong>{{ $listPermissionsInAllModules[$moduleID]['module_name'] }}</strong> <br /> <br />
									@foreach($listPermissionsInAllModules[$moduleID]['list'] as $permission )
										<input class="checkboxPermission checkboxFromModule_{{$moduleID}}" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}> {{ $permission->title }}<br>
									@endforeach	
								</div>
							</div>
						@endforeach
					</div>
					
					<div class="row">
						@foreach($permissions as $permission)
						<div class="col-4">
							<input class="checkboxPermission" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}> {{ $permission->title }}<br>
						</div>
						@endforeach
					</div>
                    
                </div>
            </div>
			
        </div>
    </div>
</div>