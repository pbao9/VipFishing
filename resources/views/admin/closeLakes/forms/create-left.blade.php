<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoCloseLakes') }}</h2>
        </div>
        <div class="row card-body">
            <!-- lakechild_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên hồ lẻ') }}:</label>
                    <x-select class="select2-bs5-ajax" id="search-select-lakechild" name="lakechild_id"
                              :data-url="route('admin.search.select.lakechild')" :required="true"></x-select>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày đóng cửa') }} :</label>
                    <x-input type="date" id="close_date" name="close_date" :value="old('close_date')"
                             placeholder="{{ __('Ngày đóng cửa') }}" :required="true" />
                </div>
            </div>
            <!-- open_date -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày mở cửa') }} :</label>
                    @php
                        $formattedOpenDate = old('open_date') ? \Carbon\Carbon::parse(old('open_date'))->format('d-m-Y') : null;
                    @endphp

                    <x-input type="date" id="open_date" name="open_date" :value="$formattedOpenDate"
                             placeholder="{{ __('Ngày mở cửa') }}" :required="true" />
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng số ngày đóng cửa') }} : <span id="close_days"></span></label>
                </div>
                <div class="mb-3">
                    <label class="control-label">{{ __('Số booking bị ảnh hưởng') }} : <span id="canceled_bookings" ></span></label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng giá trị booking phải hoàn lại') }} : <span id="total_refund_amount"></span></label>
                </div>
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng phí bồi thường') }} : <span id="compensation_amount"></span></label>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery and Select2 JS if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

