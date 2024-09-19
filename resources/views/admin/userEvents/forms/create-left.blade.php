<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin UserEvents') }}</h2>
        </div>
        <div class="row card-body">
            <!-- event_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã sự kiện') }}:</label>
                    <x-select name="event_id">
                        <x-select-option value="" title="" />

                    </x-select>
                </div>
            </div><!-- user_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã người dùng') }}:</label>
                    <x-select name="user_id">
                        <x-select-option value="" title="" />

                    </x-select>
                </div>
            </div><!-- has_reward -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Trạng thái nhận quà') }}:</label>
                    <x-select name="has_reward">
                        <x-select-option value="yes" title="yes" />
                        <x-select-option value="no" title="no" />

                    </x-select>
                </div>
            </div>

        </div>
    </div>
</div>