<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Cá thả') }}</h2>
        </div>
        <div class="row card-body">
        <!-- lakeChild_id -->
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mã hồ lẻ') }}:</label>
                <x-select class="select2-bs5-ajax" id="lakechildsSelect" name="lakechild_id" :data-url="route('admin.search.select.lakechilds')"></x-select>
            </div>
        </div><!-- fish_id -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mã cá') }}:</label>
                <x-select class="select2-bs5-ajax" name="fish_id" id="fishsSelect" :data-url="route('admin.search.select.fishs')"></x-select>

            </div>
        </div>
        </div>
    </div>
</div>
