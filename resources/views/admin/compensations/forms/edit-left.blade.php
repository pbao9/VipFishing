{{--<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoCompensation') }}</h2>

        </div>
        <div class="row card-body">
            <!-- amount -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tiền bồi thường') }} :</label>
                    <x-input type="number" name="amount" :value="$compensations->amount"
                        placeholder="{{ __('Số tiền bồi thường') }}" />
                </div>
            </div>
            <!-- booking_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã booking') }}:</label>
                    <x-select name="booking_id" :required="true">
                        @php
                            $titleBooking = $compensations->booking->id . ' - ' . $compensations->booking->lakechild->name . ' - ' . number_format($compensations->booking->total_price, 0, ',', '.') . 'VNĐ'
                        @endphp
                        <x-select-option :option="$compensations->booking_id" :value="$compensations->booking_id"
                            :title="$titleBooking" />
                    </x-select>
                </div>
            </div>
            <!-- user_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã người dùng') }}:</label>
                    <x-select name="user_id" :required="true">
                        @php
                            $titleUser = $compensations->user->fullname . ' - ' . $compensations->user->phone
                        @endphp
                        <x-select-option :option="$compensations->user_id" :value="$compensations->user_id"
                            :title="$titleUser" />
                    </x-select>
                </div>
            </div>

        </div>
    </div>
</div>
--}}