<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin biến thể') }} - <x-link class="text-primary" :href="route('admin.attribute.edit', optional($variation->attribute)->id)" :title="optional($variation->attribute)->name" /></h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên biến thể') }}:</label>
                    <x-input name="name" :value="$variation->name" :required="true"
                        placeholder="{{ __('Tên biến thể') }}" />
                </div>
            </div>
            
            @includeWhen($has_meta_value_color, 'admin.variations.forms.fields.meta-value-color')
            <!-- position -->
            <div class="col-md-12 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Vị trí') }}:</label>
                    <x-input type="number" name="position" :value="$variation->position" :required="true" />
                </div>
            </div>
            
            <!-- desc -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả') }}:</label>
                    <textarea class="form-control" name="desc">{{ $variation->desc }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>