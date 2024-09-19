<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin Module') }}</h2>
           
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên Module') }}:</label>
                    <x-input name="name" :value="$module->name" :required="true"
                        placeholder="{{ __('Ví dụ: Sửa Module') }}" />
                </div>
            </div>
			
			<!-- permission -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Các chức năng trong Module ( Permission )') }}:</label>
					<ol>
                    @foreach($listpermissions as $permission)
						<li>{{ $permission->title }}</li>
					@endforeach
					</ol>
                </div>
            </div>
			
			
			<!-- desc -->
			<div class="col-12">
				<div class="mb-3">
					<label class="control-label">{{ __('Mô tả') }}:</label>
					<textarea name="description" class="ckeditor visually-hidden">{{ $module->description }}</textarea>
				</div>
			</div>
			
        </div>
    </div>
</div>