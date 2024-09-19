<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoCloseLake') }}</h2>
        </div>
        <div class="row card-body">
            <!-- lakechild_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên hồ lẻ') }}:</label>
                        <x-input readonly name="lakechild_id" :value="$closeLakes->lakechild->name" :title="$closeLakes->lakechild->name" />
                </div>
            </div>
            <!-- close_date -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày đóng cửa') }} :</label>
                    <x-input readonly type="date" name="close_date"
                        value="{{ \Carbon\Carbon::parse($closeLakes->close_date)->format('Y-m-d') }}"
                        placeholder="{{ __('Ngày đóng cửa') }}" :required="true" />
                </div>
            </div>
            <!-- open_date -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày mở cửa') }} :</label>
                    <x-input readonly type="date" name="close_date"
                             value="{{ \Carbon\Carbon::parse($closeLakes->open_date)->format('Y-m-d') }}"
                             placeholder="{{ __('Ngày mở cửa') }}" :required="true" />
                </div>
            </div>
            <!-- close_days -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng số ngày đóng cửa') }} :</label>
                    <x-input readonly type="integer" min="0" name="close_days"
                        :value="$closeLakes->close_days"
                        placeholder="{{ __('Tổng số ngày đóng cửa') }}" :required="true" />
                </div>
            </div>
            <!-- canceled_bookings -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số booking bị ảnh hưởng') }} :</label>
                    <x-input id="canceled_bookings" type="number" name="canceled_bookings"
                             :value="$closeLakes->canceled_bookings"
                             readonly/>
                </div>
            </div>
            <!-- total_refund_amount -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng giá trị booking phải hoàn lại') }} :</label>
                    <x-input id="total_refund_amount" type="number" name="total_refund_amount"
                             :value="$closeLakes->total_refund_amount"
                             readonly/>
                </div>
            </div>
            <!-- compensation_amount -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng phí bồi thường') }} :</label>
                    <x-input id="compensation_amount" type="number" name="compensation_amount"
                             :value="$closeLakes->compensation_amount"
                             readonly/>
                </div>
            </div>
        </div>
    </div>
</div>
