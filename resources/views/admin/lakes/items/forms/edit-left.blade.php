<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#tabs-information" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                        role="tab">{{ __('Thông tin hồ') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-activity" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab"
                        tabindex="-1">{{ __('Lịch hoạt động') }}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="tabs-information" role="tabpanel">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h2 class="mb-0">{{ __('infoLakeChild') }} - Thuộc:
                                <x-link class="text-primary" :href="route('admin.lakes.edit', optional($lakechilds->lake)->id)" :title="optional($lakechilds->lake)->name" />
                            </h2>
                            <span class="text-primary">Mật độ cá:
                                {{ $lakechilds->fish_density }}<small>kg/m2</small></span>
                        </div>
                        <div class="row card-body">
                            <!-- name -->
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Tên') }} :</label>
                                    <x-input name="name" :value="$lakechilds->name" placeholder="{{ __('Tên') }}" />
                                </div>
                            </div>
                            <!-- area -->
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Diện tích hồ') }} : <small>m2</small></label>

                                    <x-input type="number" name="area" :value="$lakechilds->area"
                                        placeholder="{{ __('Diện tích hồ') }}" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Số lượng chỗ ngồi') }} :</label>
                                    <x-input name="slot" :value="$lakechilds->slot" />
                                </div>
                            </div>
                            <!-- open_time -->
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Thời gian mở cửa') }} :</label>
                                    <x-input type="time" name="open_time" :value="$lakechilds->open_time"
                                        placeholder="{{ __('Thời gian mở cửa') }}" />
                                </div>
                            </div><!-- close_time -->
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Thời gian đóng cửa') }} :</label>
                                    <x-input type="time" name="close_time" :value="$lakechilds->close_time"
                                        placeholder="{{ __('Thời gian đóng cửa') }}" />
                                </div>
                            </div>
                            <!-- type -->
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Loại hồ') }}:</label>
                                    <x-select name="type">
                                        <x-select-option :option="$lakechilds->type" value="0" title="Loại 1" />
                                        <x-select-option :option="$lakechilds->type" value="1" title="Loại 2" />
                                    </x-select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Khối lượng cá') }} : <small>kg</small></label>
                                    <x-input type="number" name="fish_volume" :value="$lakechilds->fish_volume"
                                        placeholder="{{ __('Khối lượng cá') }}" />
                                </div>
                            </div>
                            <!-- fishing_rod_limit -->
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Giới hạn cần') }} :</label>
                                    <x-input type="number" name="fishing_rod_limit" :value="$lakechilds->fishing_rod_limit"
                                        placeholder="{{ __('Giới hạn cần') }}" />
                                </div>
                            </div>
                            <!-- compensation -->
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Đền bù') }} : <small>%</small></label>
                                    <x-input type="number" name="compensation" :value="$lakechilds->compensation"
                                        placeholder="{{ __('Đền bù') }}" />
                                </div>
                            </div><!-- collect_fish_price -->
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Giá thu cá') }} : <small>VNĐ</small></label>
                                    <x-input type="number" name="collect_fish_price" :value="$lakechilds->collect_fish_price"
                                        placeholder="{{ __('Giá thu cá') }}" />
                                </div>
                            </div><!-- collect_fish_type -->
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Loại cá thu') }}:</label>
                                    <x-select name="collect_fish_type">
                                        <x-select-option :option="$lakechilds->collect_fish_type" value="0" title="Kg" />
                                        <x-select-option :option="$lakechilds->collect_fish_type" value="1" title="Con" />
                                    </x-select>
                                </div>
                            </div>
                            <!-- description -->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="control-label">{{ __('Mô tả') }} :</label>
                                    <x-textarea class="ckeditor visually-hidden"
                                        name="description">{{ $lakechilds->description }}</x-textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-activity" role="tabpanel">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
