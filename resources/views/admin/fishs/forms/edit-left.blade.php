<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoFishs') }}</h2>
            <x-link :href="route('admin.fishs.item.index', ['fish_id' => $fishs['id']])" :title="__('Các Biến thể')" />
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên cá') }} :</label>
                    <x-input name="name" :value="$fishs->name" placeholder="{{ __('Tên cá') }}" />
                </div>
            </div><!-- province_code -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã tỉnh') }} :</label>
                    <x-select class="select2-bs5-ajax" name="province_id" :required="true">
                        <x-select-option :option="$fishs->province_id" :value="$fishs->province_id" :title="optional($fishs->provinces)->name" />
                    </x-select>
                </div>
            </div>

        </div>
    </div>
</div>
