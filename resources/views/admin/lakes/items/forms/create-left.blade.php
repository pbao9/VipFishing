<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoLakeChild') }} - <x-link class="text-primary" :href="route('admin.lakes.edit', $lake->id)"
                    :title="$lake->name" /></h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên') }} :</label>
                    <x-input name="name" :value="old('name')" placeholder="{{ __('Tên') }}" />
                </div>
            </div>
            <!-- area -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Diện tích hồ') }} : <small>m2</small></label>
                    <x-input type="number" name="area" :value="old('area', 0)" min="0"
                        placeholder="{{ __('Diện tích hồ') }}" />
                </div>
            </div>

            <!-- slot -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số lượng chỗ ngồi') }} :</label>
                    <x-input name="slot" :value="old('slot', 0)" min="0" />
                </div>
            </div>
            <!-- type -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại hồ') }}:</label>
                    <x-select name="type">
                        <x-select-option value="0" title="Loại 1" />
                        <x-select-option value="1" title="Loại 2" />
                    </x-select>
                </div>
            </div>
            <!-- open_time -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian mở cửa') }} :</label>
                    <x-input type="time" name="open_time" :value="old('open_time')"
                        placeholder="{{ __('Thời gian mở cửa') }}" />
                </div>
            </div><!-- close_time -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian đóng cửa') }} :</label>
                    <x-input type="time" name="close_time" :value="old('close_time')"
                        placeholder="{{ __('Thời gian đóng cửa') }}" />
                </div>
            </div>
            <!-- compensation -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Đền bù') }} : <small>%</small></label>
                    <x-input type="number" name="compensation" :value="old('compensation', 0)" placeholder="{{ __('%') }}"
                        min="0" max="100" />
                </div>
            </div>
            <!-- fish_volume -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Khối lượng cá') }} : <small>kg</small></label>
                    <x-input type="number" name="fish_volume" :value="old('fish_volume', 0)" min="0"
                        placeholder="{{ __('Khối lượng cá') }}" />
                </div>
            </div>
            <!-- fishing_rod_limit -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giới hạn cần') }} :</label>
                    <x-input type="number" name="fishing_rod_limit" :value="old('fishing_rod_limit', 0)" min="0"
                        placeholder="{{ __('Giới hạn cần') }}" />
                </div>
            </div>
            <!-- collect_fish_price -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá thu cá') }} : <small>VNĐ</small></label>
                    <x-input type="number" name="collect_fish_price" :value="old('collect_fish_price', 0)"
                        placeholder="{{ __('Giá thu cá') }}" />
                </div>
            </div><!-- collect_fish_type -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại cá thu') }}:</label>
                    <x-select name="collect_fish_type">
                        <x-select-option value="0" title="Kg" />
                        <x-select-option value="1" title="Con" />

                    </x-select>
                </div>
            </div><!-- commission_rate -->
            <!-- description -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả') }}:</label>
                    <textarea name="description" class="ckeditor visually-hidden">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
