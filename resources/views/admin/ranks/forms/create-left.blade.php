<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Xếp Loại') }}</h2>
        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tiêu đề') }} :</label>
                    <x-input name="title" :value="old('title')" placeholder="{{ __('Tiêu đề') }}" />
                </div>
            </div><!-- hcv_point -->
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="control-label">{{ __('Điểm HCV') }} :</label>
                    <x-input type="number" name="hcv_point" :value="old('hcv_point')" placeholder="{{ __('Điểm HCV') }}" />
                </div>
            </div><!-- ccv_point -->
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="control-label">{{ __('Điểm CCV') }} :</label>
                    <x-input type="number" name="ccv_point" :value="old('ccv_point')" placeholder="{{ __('Điểm CCV') }}" />
                </div>
            </div><!-- round -->
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số trận đấu') }} :</label>
                    <x-input type="number" name="round" :value="old('round')" placeholder="{{ __('Số trận đấu') }}" />
                </div>
            </div><!-- award -->
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số Giải Đạt Được') }} :</label>
                    <x-input type="number" name="awards" :value="old('awards')" placeholder="{{ __('Số hồ') }}" />
                </div>
            </div><!-- lake -->
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số hồ') }} :</label>
                    <x-input type="number" name="lake" :value="old('lake')" placeholder="{{ __('Số hồ') }}" />
                </div>
            </div><!-- province -->
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tỉnh') }} :</label>
                    <x-input type="number" name="province" :value="old('province')" placeholder="{{ __('Số tỉnh') }}" />
                </div>
            </div><!-- stauts_comission -->
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="control-label">{{ __('Trạng thái nhận hoa hồng') }}:</label>
                    <x-select name="stauts_comission" :required="true">
                        <x-select-option value="" :title="__('Chọn Trạng thái nhận hoa hồng')" />
                            @foreach ($stauts_comission as $key => $value)
                                <x-select-option :value="$key" :title="__($value)" />
                            @endforeach
                    </x-select>
                </div>
            </div><!-- rating -->
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số lượt đánh giá') }} :</label>
                    <x-input type="number" name="rating" :value="old('rating')"
                        placeholder="{{ __('Số lượt đánh giá') }}" />
                </div>
            </div>

        </div>
    </div>
</div>
