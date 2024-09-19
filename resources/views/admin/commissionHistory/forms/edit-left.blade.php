{{--<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoCommission') }}</h2>

        </div>
        <div class="row card-body">
            <!-- amount -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tiền nhận hoa hồng') }} :</label>
                    <x-input type="number" name="amount" :value="$commissionHistory->amount"
                        placeholder="{{ __('Số tiền nhận hoa hồng') }}" />
                </div>
            </div>
            <!-- booking_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã booking') }}:</label>
                    <x-select name="booking_id" :required="true">
                        @php
                            $titleBooking = $commissionHistory->booking->id . ' - ' . $commissionHistory->booking->lakechild->name . ' - ' . number_format($commissionHistory->booking->total_price, 0, ',', '.') . 'VNĐ'
                        @endphp
                        <x-select-option :option="$commissionHistory->booking_id" :value="$commissionHistory->booking_id"
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
                            $titleUser = $commissionHistory->user->fullname . ' - ' . $commissionHistory->user->phone
                        @endphp
                        <x-select-option :option="$commissionHistory->user_id" :value="$commissionHistory->user_id"
                            :title="$titleUser" />
                    </x-select>
                </div>
            </div>
        </div>
    </div>
</div>--}}