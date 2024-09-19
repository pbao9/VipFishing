<div id="variations" class="tab-pane" role="tabpanel" aria-labelledby="tabVariations">
    @if(isset($product) && $product->productAttributes->count() > 0)
        @include('admin.products.data.partials.variations', [
            'actions' => App\Enums\Product\ProductVariationAction::asSelectArray(),
            'productVariations' => $product->productVariations,
            'arrProductAttributes' => $product->arrProductAttributes
        ])
    @else
        @include('admin.products.data.partials.no-variation')
    @endif
</div>
