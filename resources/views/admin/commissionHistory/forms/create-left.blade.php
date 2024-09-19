{{--<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoCommission') }}</h2>
        </div>
        <div class="row card-body">
            <!-- amount -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tiền nhận hoa hồng') }} :</label>
                    <x-input type="number" name="amount" :value="old('amount')"
                        placeholder="{{ __('Số tiền nhận hoa hồng') }}" />
                </div>
            </div>
            <!-- booking_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã booking') }}:</label>
                    <x-select class="select2-bs5-ajax" id="search-select-booking" name="booking_id"
                        :data-url="route('admin.search.select.booking')" :required="true"></x-select>
                </div>
            </div>
            <!-- user_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã người dùng') }}:</label>
                    <x-select class="select2-bs5-ajax" id="search-select-user" name="user_id"
                        :data-url="route('admin.search.select.user')" :required="true"></x-select>
                </div>
            </div>

        </div>
    </div>
</div>--}}