<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Nhà hồ') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên nhà hồ') }} :</label>
                    <x-input name="name" :value="old('name')" placeholder="{{ __('Tên nhà hồ') }}" />
                </div>
            </div>
            <!-- phone -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số điện thoại') }} :</label>
                    <x-input type="number" name="phone" :value="old('phone')" placeholder="{{ __('Số điện thoại') }}" />
                </div>
            </div>
            <!-- province -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tỉnh') }} :</label>
                    <x-select class="select2-bs5-ajax" name="province_id" :data-url="route('admin.search.select.provinces')"></x-select>
                </div>
            </div>
            {{--            <!-- map --> --}}
            <div class="col-12">
                <div class="mb-3">
                    <x-input-pick-address :label="trans('address')" name="map" :placeholder="trans('pickAddress')" :required="true" />
                    <x-input type="hidden" name="lat" />
                    <x-input type="hidden" name="lng" />
                </div>
            </div>
            <!-- car_parking -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Chỗ đậu ÔTÔ') }} :</label>
                    <x-input type="number" name="car_parking" :value="old('car_parking', 0)" min="0" />
                </div>
            </div>
            <!-- dinner -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Bữa tối') }}:</label>
                    <x-select name="dinner">
                        <x-select-option value="1" title="Có" />
                        <x-select-option value="2" title="Không" />
                    </x-select>
                </div>
            </div>
            <!-- lunch -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Bữa trưa') }}:</label>
                    <x-select name="lunch">
                        <x-select-option value="1" title="Có" />
                        <x-select-option value="2" title="Không" />

                    </x-select>
                </div>
            </div><!-- toilet -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Toilet') }}:</label>
                    <x-select name="toilet">
                        <x-select-option value="1" title="Có" />
                        <x-select-option value="2" title="Không" />

                    </x-select>
                </div>
            </div>
            {{--            <!-- description --> --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả') }}:</label>
                    <textarea name="description" class="ckeditor visually-hidden">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
