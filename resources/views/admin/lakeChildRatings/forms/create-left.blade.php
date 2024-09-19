<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Ratings') }}</h2>
        </div>
        <div class="row card-body">
            <!-- feedback -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Phản hồi') }} :</label>
                    <x-input name="feedback" :value="old('feedback')"
                             placeholder="{{ __('Phản hồi') }}"/>
                </div>
            </div>
            <!-- rate -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Đánh giá') }} :</label>
                    <x-input min="1" max="5" type="number" name="rate" :value="old('rate')"
                             placeholder="{{ __('Đánh giá') }}"/>
                </div>
            </div>
            <!-- note -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ghi chú') }} :</label>
                    <x-input name="note" :value="old('note')"
                             placeholder="{{ __('Ghi chú') }}"/>
                </div>
            </div>

            <!-- lake_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã nhà hồ') }}:</label>
                    <x-select name="lake_id">
                        @foreach ($joinlake as $lake)
                            <option value="{{ $lake->id }}"
                                    title="{{ $lake->name }}">{{$lake->id.'-'. $lake->name }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- lakechild_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã hồ lẻ') }}:</label>
                    <x-select name="lakechild_id">
                        @foreach ($joinlakechild as $lakechild)
                            <option value="{{ $lakechild->id }}"
                                    title="{{ $lakechild->name }}">{{$lakechild->id.'-'. $lakechild->name }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- booking_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã suất câu') }}:</label>
                    <x-select name="booking_id">
                        @foreach ($joinbooking as $booking)
                            <option value="{{ $booking->id }}" title="{{ $booking->id }}">{{$booking->id}}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
        </div>
    </div>
</div>

