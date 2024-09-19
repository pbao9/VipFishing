<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin slider') }}</h2>
            <x-link :href="route('admin.slider.item.index', $slider->id)" :title="__('Các Slider items')" />
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên slider') }}:</label>
                    <x-input name="name" :value="$slider->name" :required="true"
                        placeholder="{{ __('Tên slider') }}" />
                </div>
            </div>
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Key') }}:</label>
                    <x-input name="plain_key" :value="$slider->plain_key" :required="true"
                        placeholder="{{ __('Định danh slider') }}" />
                </div>
            </div>
            <!-- desc -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả') }}:</label>
                    <textarea class="form-control" name="desc">{{ $slider->desc }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>