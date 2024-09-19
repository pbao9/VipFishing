<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoFishs') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên cá') }} :</label>
                    <x-input name="name" :value="old('name')" placeholder="{{ __('Tên cá') }}" />
                </div>
            </div><!-- province_code -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tỉnh/thành') }} :</label>
                    <x-select class="select2-bs5-ajax" name="province_id" :data-url="route('admin.search.select.provinces')"></x-select>
                </div>
            </div>

        </div>
    </div>
</div>
