<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoEvent') }}</h2>
        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tiêu đề') }} :</label>
                    <x-input name="title" :value="old('title')" placeholder="{{ __('Tiêu đề') }}" required="true" />
                </div>
            </div>
            <!-- reward -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Phần thưởng') }}:</label>
                    <textarea name="reward" class="ckeditor visually-hidden"
                        required="true">{{ old('reward') }}</textarea>
                </div>
            </div>
            <!-- reward_value -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá trị phần thưởng') }} :</label>
                    <x-input type="number" name="reward_value" :value="old('reward_value')"
                        placeholder="{{ __('Giá trị phần thưởng') }}" min="1" required="true" />
                </div>
            </div>
            <!-- reward_quantity -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số lượng phần thưởng') }} :</label>
                    <x-input type="number" name="reward_quantity" :value="old('reward_quantity')"
                        placeholder="{{ __('Số lượng phần thưởng') }}" min="0" required="true" />
                </div>
            </div>
            <!-- start_date -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian bắt đầu') }} :</label>
                    <x-input type="date" name="start_date" :value="old('start_date')"
                        placeholder="{{ __('Thời gian bắt đầu') }}" required="true" />
                </div>
            </div>
            <!-- end_date -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian kết thúc') }} :</label>
                    <x-input type="date" name="end_date" :value="old('end_date')"
                        placeholder="{{ __('Thời gian kết thúc') }}" required="true" />
                </div>
            </div>
        </div>
    </div>
</div>