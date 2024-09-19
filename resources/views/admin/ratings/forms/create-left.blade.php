<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- feedback -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Phản hồi') }} :</label>
                    <x-input name="feedback" :value="old('feedback') ?? ($ratings->first()->feedback ?? '')" placeholder="{{ __('Phản hồi') }}" />
                </div>
            </div>
            <!-- rate -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Đánh giá') }} :</label>
                    <x-input min="1" max="5" type="number" name="rate" :value="old('rate') ?? ($ratings->first()->rate ?? '')"
                        placeholder="{{ __('Đánh giá') }}" />
                </div>
            </div>
            <!-- note -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ghi chú') }} :</label>
                    <textarea class="form-control" rows="12" name="note" placeholder="{{ __('Ghi chú') }}">{{ $ratings->first()->note ?? '' }}</textarea>
                </div>
            </div>

            <input type="hidden" value="{{ $bookings->id }}" name="booking_id">
        </div>
    </div>
</div>
