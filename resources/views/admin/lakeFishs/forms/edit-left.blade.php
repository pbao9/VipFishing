<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin Cá thả') }}</h2>
        </div>
        <div class="row card-body">
            <!-- lakeChild_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã hồ lẻ') }}:</label>
                    <x-select class="select2-bs5-ajax" name="lakechild_id" id="lakechildsSelect" :required="true">
                        <x-select-option :option="$lakeFishs->lake_child->id" :value="$lakeFishs->lake_child->id"
                                         :title="$lakeFishs->lake_child->name"/>
                    </x-select>
                </div>
            </div><!-- fish_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã cá') }}:</label>
                    <x-select class="select2-bs5-ajax" name="fish_id" id="fishsSelect" :required="true">
                        <x-select-option :option="$lakeFishs->fish->id" :value="$lakeFishs->fish->id"
                                         :title="$lakeFishs->fish->name"/>
                    </x-select>
                </div>
            </div>
        </div>

    </div>
</div>
