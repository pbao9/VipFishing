<div class="row g-0 wrap-select-attribute border-bottom gap-2 p-3">
    <div class="col">
        <x-select name="variation_action">
            @foreach ($actions as $key => $value)
                <x-select-option :value="$key" :title="$value" />
            @endforeach
        </x-select>
    </div> 
    <div class="col-auto">
        <button type="button" id="btnVariationAddNew" class="btn btn-outline-primary">{{ __('Thêm') }}</button>
    </div>
</div>
<div id="listVariation" class="wrap-variation d-flex flex-column gap-2 reorder-list">
    @isset($productVariations)
        @foreach ($productVariations as $productVariation)
            @include('admin.products.data.partials.product-variations', [
                'productVariation' => $productVariation,
                'attributeVariations' => $arrProductAttributes
            ])
        @endforeach
    @endif
</div>