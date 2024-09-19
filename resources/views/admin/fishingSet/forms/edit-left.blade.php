<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoFishingSet') }}</h2>

        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tiêu đề') }} :</label>
                    <x-input name="title" :value="$fishingSet->title" placeholder="{{ __('Tiêu đề') }}"/>
                </div>
            </div><!-- time_start -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian bắt đầu') }} :</label>
                    <x-input id="time_start" type="time" name="time_start" :value="$fishingSet->time_start"
                             placeholder="{{ __('Thời gian bắt đầu') }}"/>
                </div>
            </div><!-- time_end -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian kết thúc') }} :</label>
                    <x-input id="time_end" type="time" name="time_end" :value="$fishingSet->time_end"
                             placeholder="{{ __('Thời gian kết thúc') }}"/>
                </div>
            </div>
            <!-- duration -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời lượng') }}(tiếng) :</label>
                    <x-input id="duration" type="number" min="0" name="duration" :value="$fishingSet->duration"
                             placeholder="{{ __('Thời lượng') }}" readonly/>
                </div>
            </div>
            <!-- time_checkin -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian lấy số') }} :</label>
                    <x-input id="time_checkin" type="time" name="time_checkin" :value="$fishingSet->time_checkin"
                    />
                </div>
            </div>
        </div>
    </div>
</div>

