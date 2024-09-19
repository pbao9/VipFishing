<div class="wrap-item-attribute ui-sortable-handle bg-white" data-attribute-id="{{ $attribute->id }}">
    <div class="d-flex shadow-sm justify-content-between align-items-center p-3 border-bottom" 
        data-bs-toggle="collapse" 
        data-bs-target="#collapseAttribute{{ $attribute->id }}" 
        aria-expanded="false" 
        aria-controls="collapseAttribute{{ $attribute->id }}">
        <span class="attribute-name flex-fill">{{ $attribute->name }}</span>
        <div class="wrap-action d-flex gap-2">
            <span class="cursor-move"><i class="ti ti-menu-order"></i></span>
            <x-button type="button" 
                :data-product-attribute-delete-route="isset($productAttributeId) ? route('admin.product.attribute.delete', $productAttributeId) : 0" 
                class="badge badge-outline text-red remove-attribute-item">
                {{ __('Xóa') }}
            </x-button>
        </div>
    </div>
    <div class="collapse" id="collapseAttribute{{ $attribute->id }}">
        <div class="row g-0 p-3 bg-muted-lt">
            <div class="col">
                <x-input type="hidden" 
                    class="input-product-attribute-id" 
                    name="product_attribute[attribute_id][]" 
                    :value="$attribute->id"/>
                <div class="">
                    <label for="">{{ __('Chọn biến thể') }}:</label>
                    <x-select class="select2-bs5 select-product-attribute-variation-id" 
                        name="product_attribute[attribute_variation_id][{{$attribute->id}}][]" 
                        multiple="multiple" :required="true">
                        @foreach ($attribute->variations as $variation)
                            <x-select-option :option="$attributeVariations ?? ''" 
                                :value="$variation->id" 
                                :title="$variation->name"/>
                        @endforeach
                    </x-select>
                </div>
            </div>
        </div>
    </div>
</div>