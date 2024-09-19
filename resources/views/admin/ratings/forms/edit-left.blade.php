<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin Đánh giá') }}</h2>
        </div>
        <div class="row card-body">
            <!-- rate -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Trạng thái') }} :</label>
                    {{ $ratings->status }}
                </div>
            </div>
            <!-- rate -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Phản hồi') }} :</label>
                    {{ $ratings->feedback }}
                </div>
            </div>
            <!-- rate -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Đánh giá') }} :</label>
                    {{ $ratings->rate }}*
                </div>
            </div><!-- note -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ghi chú') }} :</label>
                    {{ $ratings->note ?? '' }}
                </div>
            </div><!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Nhà hồ ') }}:</label>
                    {{ isset($booking->lakechild->lake->name, $booking->lakechild->lake->phone) ? $booking->lakechild->lake->name . ' - ' . $booking->lakechild->lake->phone : $booking->lakechild->lake->name ?? ($booking->lakechild->lake->phone ?? '') }}
                </div>
            </div><!-- lakechild_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hồ lẻ ') }}:</label>
                    {{ $booking->lakechild->name }}
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã suất câu ') }}:</label>
                    {{ $booking->id }}
                </div>
            </div>
        </div>
    </div>
</div>
