<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin Xuất Câu') }}</h2>
        </div>

        <div class="row card-body">

            {{-- <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Trạng thái') }}:</label>
                    <x-select name="status" id="" required>
                        @if ($lake_cluster->status === 1)
                            <option value="1" selected>Đang hoạt động</option>
                            <option value="2">Tạm ngưng</option>
                        @else
                            <option value="2" selected>Tạm ngưng</option>
                            <option value="1">Đang hoạt động</option>
                        @endif
                    </x-select>
                </div>
            </div> --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại Xuất Câu') }}:</label>
                    <x-select name="type_fishing_rating" :required="false">
                        @foreach ($type_fishing_rating as $key => $value)
                            <x-select-option :value="$key" :title="$value" :selected="$key == $fishing_rating->type_fishing_rating" />
                        @endforeach
                    </x-select>
                </div>
            </div>

			<hr />
			
        </div>
    </div>
</div>