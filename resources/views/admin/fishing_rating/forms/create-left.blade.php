<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Xuất Câu') }}</h2>
        </div>
        <div class="row card-body">
			
			<!-- status -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại Xuất Câu') }}:</label>
                    <x-select name="type_fishing_rating" :required="true">
						@foreach ($type_fishing_rating as $key => $value)
							<x-select-option :value="$key" :title="$value" />
						@endforeach
					</x-select>
                </div>
            </div>
			
			
			<hr />
			
        </div>
    </div>
</div>