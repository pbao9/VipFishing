<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin slider item') }} - <x-link class="text-primary" :href="route('admin.slider.edit', $slider->id)" :title="$slider->name" /></h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tiêu đề') }}:</label>
                    <x-input name="title" :value="old('title')" :required="true"
                        placeholder="{{ __('Tiêu đề') }}" />
                </div>
            </div>
            <!-- link -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Link') }}:</label>
                    <x-input name="link" :value="old('link', '#')" :required="true"
                        placeholder="{{ __('link') }}" />
                </div>
            </div>
            <!-- position -->
            <div class="col-md-12 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Vị trí') }}:</label>
                    <x-input type="number" name="position" :value="old('position', 0)" :required="true" />
                </div>
            </div>
            
            <!-- mobile image -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hình ảnh mobile') }}:</label>
                    <x-input-image-ckfinder name="mobile_image" showImage="mobileImage" />
                </div>
            </div>

            <!-- image -->
            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hình ảnh') }}:</label>
                    <x-input-image-ckfinder name="image" showImage="image" />
                </div>
            </div>
        </div>
    </div>
</div>