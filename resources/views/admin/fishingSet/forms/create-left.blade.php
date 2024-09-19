<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoFishingSet') }}</h2>
        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên suất câu') }} :</label>
                    <x-input   name="title" :value="old('title')" placeholder="{{ __('Tên suất câu') }}" />
                </div>
            </div><!-- time_start -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian bắt đầu') }} :</label>
                    <x-input  id="time_start" type="time" name="time_start" :value="old('time_start')" placeholder="{{ __('Thời gian bắt đầu') }}" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian kết thúc') }} :</label>
                    <x-input  id="time_end" type="time" name="time_end" :value="old('time_end')" placeholder="{{ __('Thời gian kết thúc') }}" />
                </div>
            </div>
            <!-- duration -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời lượng') }}(tiếng) :</label>
                    <x-input id="duration" type="number" min="0" name="duration" :value="old('duration')" placeholder="{{ __('Thời lượng') }}" readonly/>
                </div>
            </div>
            <!-- Time Checkin -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian lấy số') }} :</label>
                    <x-input  id="time_checkin" type="time" name="time_checkin" :value="old('time_checkin')" />
                </div>
            </div>
        </div>
    </div>
</div>
