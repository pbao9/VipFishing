<div class="wrap-item-product-variation ui-sortable-handle bg-white">
    <div class="d-flex shadow-sm justify-content-between align-items-center border-bottom">
        <div class="wrap-select-attribute-for-variation d-flex gap-2 flex-fill p-2">
                @foreach ($attributeVariations as $keyParent => $attributeVariation)
                    <x-select name="products_variations[attribute_variation_id][{{ $identity ?? $productVariation->id ?? '' }}][]">
                        @foreach ($attributeVariation as $key => $value)
                            <x-select-option :option="$selected[$keyParent] ?? $productVariation->attributeVariations ?? ''" 
                                :value="$key" 
                                :title="$value" />
                        @endforeach
                    </x-select>
                @endforeach
            </div>
            <div class="wrap-action d-flex justify-content-end align-items-center flex-fill p-2 gap-2" 
            data-bs-toggle="collapse" 
            data-bs-target="#collapseVariation{{ $identity ?? $productVariation->id ?? '' }}" 
            aria-expanded="false" 
            aria-controls="collapseVariation{{ $identity ?? $productVariation->id ?? '' }}">
                <span class="cursor-move"><i class="ti ti-menu-order"></i></span>
                <x-button type="button"
                    class="badge badge-outline text-red remove-product-variation-item" 
                    :data-product-variaton-delete-route="isset($productVariation) ? route('admin.product.variation.delete', $productVariation->id) : 0">
                    {{ __('Xóa') }}
                </x-button>
            </div>
        </div>
        <div class="collapse" id="collapseVariation{{ $identity ?? $productVariation->id ?? '' }}">
            <x-input type="hidden" 
                    class="input-product-attribute-id" 
                    name="products_variations[id][{{ $identity ?? $productVariation->id ?? '' }}]" 
                    :value="$productVariation->id ?? 0"/>
            <div class="row g-0 p-3 bg-light">
                <div class="col-12 col-md-6 pe-md-3">
                    <label for="">{{ __('Hình ảnh') }}</label>
                    <x-input-image-ckfinder name="products_variations[image][{{ $identity ?? $productVariation->id ?? '' }}]" 
                        showImage="productVariationImage{{ $identity ?? $productVariation->id ?? '' }}" 
                        :value="$productVariation->image ?? ''"/>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="">{{ __('Giá bán thường') . ' (' . config('custom.currency') . ')' }}</label>
                        <x-input id="inputPVP{{ $identity ?? $productVariation->id ?? '' }}" 
                            name="products_variations[price][{{$identity ?? $productVariation->id ?? ''}}]" 
                            :value="$productVariation->price ?? ''" 
                            :placeholder="__('Giá bán thường')" 
                            :required="true" 
                            data-parsley-type="number" 
                            data-parsley-type-message="{{ __('Trường này phải là số.') }}" />
                    </div>
                    <div class="">
                        <label for="mb-3">{{ __('Giá khuyến mãi') . ' (' . config('custom.currency') . ')' }}</label>
                        <x-input name="products_variations[promotion_price][{{$identity ?? $productVariation->id ?? ''}}]" 
                            :value="$productVariation->promotion_price ?? ''" 
                            :placeholder="__('Giá khuyến mãi')" 
                            data-parsley-type="number"
                            data-parsley-lt="#inputPVP{{ $identity ?? $productVariation->id ?? '' }}"
                            data-parsley-number-message="Trường này phải là số."
                            data-parsley-lt-message="Giá khuyến mãi phải nhỏ hơn giá mặc định." />
                    </div>
                </div>
            </div>
        </div>
    </div>
