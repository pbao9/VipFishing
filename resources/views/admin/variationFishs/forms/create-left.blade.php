<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoVariationFishs') . ' - ' . $fish->name . ' - ' . $fish->provinces->name }}</h2>

        </div>
        <div class="row card-body">
        <!-- fish_id -->
            <div class="col-12">
            <div class="mb-3">
                <input type="hidden" name="fish_id" value="{{ $fish_id }}">
            </div>
        </div><!-- fish_density --> 
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mật độ cá') }} :</label>
                    <x-input type="text" name="fish_density" step="0.01" :value="old('fish_density')" 
                         placeholder="{{ __('Mật độ cá') }}" />
                </div>
            </div><!-- fish_price -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá cá') }} :</label>
                    <x-input type="number" name="fish_price" :value="old('fish_price')" 
                         placeholder="{{ __('Giá cá') }}" />
                </div>
            </div>
        </div>
    </div>
</div>