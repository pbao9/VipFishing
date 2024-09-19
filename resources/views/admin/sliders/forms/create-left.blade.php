<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin slider') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên slider') }}:</label>
                    <x-input name="name" :value="old('name')" :required="true"
                        placeholder="{{ __('Tên slider') }}" />
                </div>
            </div>
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Key') }}:</label>
                    <x-input name="plain_key" :value="old('plain_key')" :required="true"
                        placeholder="{{ __('Định danh slider') }}" />
                </div>
            </div>
            <!-- desc -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả') }}:</label>
                    <textarea class="form-control" name="desc">{{ old('desc') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>