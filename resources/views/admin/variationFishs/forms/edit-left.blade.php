<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoVariationFishs')}} - <x-link class="text-primary" :href="route('admin.fishs.edit', optional($variationFishs->fish)->id)" :title="optional($variationFishs->fish)->name .' - ' . ($variationFishs->fish->provinces)->name" />
            </h2>
        </div>
        <div class="row card-body">
            <!-- fish_id -->
            <div class="col-12">
            <div class="mb-3">
                
                <input type="hidden" name="fish_id" value="{{ $variationFishs->fish->id }}">
            </div>
            <!-- fish_density -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mật độ cá') }}:</label>
                    <x-input type="text" name="fish_density" :value="$variationFishs->fish_density" placeholder="{{ __('Mật độ cá') }}" />
                </div>
            </div>
            <!-- fish_price -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá cá') }}:</label>
                    <x-input type="number" name="fish_price" :value="$variationFishs->fish_price" placeholder="{{ __('Giá cá') }}" />
                </div>
            </div>
        </div>
    </div>
</div>
</div>