<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin Nhà hồ') }}</h2>
            <div class="d-flex flex-column align-items-start">

                <x-link
                    :href="route('admin.lakes.item.index', ['lake_id' => $lakes['id']])"
                    class="d-flex align-items-center text-decoration-none">
                    <i class="ti ti-menu-2 px-2"></i>
                    {{ __('Danh sách hồ lẻ') }}
                </x-link>
            </div>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên') }} :</label>
                    <x-input name="name" :value="$lakes->name" placeholder="{{ __('Tên') }}"/>
                </div>
            </div><!-- phone -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số điện thoại') }} :</label>
                    <x-input type="number" name="phone" :value="$lakes->phone" placeholder="{{ __('Số điện thoại') }}"/>
                </div>
            </div><!-- address -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Vị trí') }} :</label>
                    <x-select class="select2-bs5-ajax" name="province_id" :required="true">
                        <x-select-option :option="$lakes->province_id" :value="$lakes->province_id" :title="optional($lakes->provinces)->name" />
                    </x-select>
                </div>

            </div><!-- map -->
            <div class="col-12">
                <div class="mb-3">
                    <x-input-pick-address :label="trans('address')" name="map" :value="$lakes->map"
                                          :placeholder="trans('pickAddress')"
                                          :required="true"/>
                    <x-input type="hidden" name="lat" :value="$lakes->longitude"/>
                    <x-input type="hidden" name="lng" :value="$lakes->latitude"/>
                </div>
            </div><!-- car_parking -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Chỗ đậu ÔTÔ') }} :</label>
                    <x-input type="number" name="car_parking" :value="$lakes->car_parking" min="0"/>
                </div>
            </div>
            <!-- dinner -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Bữa tối') }}:</label>
                    <x-select name="dinner">
                        @if ($lakes->dinner == 1)
                            <option value="1" selected>Có</option>
                            <option value="2">Không</option>
                        @else
                            <option value="1">Có</option>
                            <option value="2" selected>Không</option>
                        @endif

                    </x-select>
                </div>
            </div><!-- lunch -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Bữa trưa') }}:</label>
                    <x-select name="lunch">
                        @if ($lakes->lunch == 1)
                            <option value="1" selected>Có</option>
                            <option value="2">Không</option>
                        @else
                            <option value="1">Có</option>
                            <option value="2" selected>Không</option>
                        @endif
                    </x-select>
                </div>
            </div><!-- toilet -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Toilet') }}:</label>
                    <x-select name="toilet">
                        @if ($lakes->toilet == 1)
                            <option value="1" selected>Có</option>
                            <option value="2">Không</option>
                        @else
                            <option value="1">Có</option>
                            <option value="2" selected>Không</option>
                        @endif

                    </x-select>
                </div>
            </div>
            <!-- description -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả') }} :</label>
                    <x-textarea class="ckeditor visually-hidden"
                                name="description">{{ $lakes->description }}</x-textarea>
                </div>
            </div>
        </div>
    </div>
</div>
