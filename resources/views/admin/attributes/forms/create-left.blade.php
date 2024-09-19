<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin thuộc tính') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên thuộc tính') }}:</label>
                    <x-input name="name" :value="old('name')" :required="true"
                        placeholder="{{ __('Tên thuộc tính') }}" />
                </div>
            </div>
            <!-- type -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại') }}:</label>
                    <x-select class="select2-bs5" name="type" :required="true">
                        @foreach ($type as $key => $value)
                            <x-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- position -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Vị trí') }}:</label>
                    <x-input type="number" name="position" :value="old('position', 0)" :required="true" />
                </div>
            </div>
            <!-- desc -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả') }}:</label>
                    <textarea class="form-control" name="desc">{{ old('desc') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>