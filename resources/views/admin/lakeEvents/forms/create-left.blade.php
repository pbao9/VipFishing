<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin LakeEvents') }}</h2>
        </div>
        <div class="row card-body">
        <!-- event_id -->
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mã sự kiện') }}:</label>
                <x-select name="event_id" >
    				<x-select-option value="" title="" />

				</x-select>
            </div>
        </div><!-- lakeChild_id -->
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mã hồ lẻ') }}:</label>
                <x-select name="lakeChild_id" >
    				<x-select-option value="" title="" />

				</x-select>
            </div>
        </div>

        </div>
    </div>
</div>