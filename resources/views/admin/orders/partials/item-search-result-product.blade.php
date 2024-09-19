<div class="list-group-item">
    <div class="row align-items-center">
        <div class="col-auto">
            <img class="avatar" src="{{ asset($product->avatar) }}" alt="">
        </div>
        <div class="col text-truncate d-flex justify-content-between">
            <div class="">
                <span class="">{{ $product->name }}</span>
                @if ($product->isSimple())
                    <small>
                        <span class="mx-1">-</span>
                        (
                        @if ($product->promotion_price)
                            {{ format_price($product->promotion_price) }}
                            <span> - </span>
                            <s>{{ format_price($product->price) }}</s>
                        @else
                            {{ format_price($product->price) }}
                        @endif
                        )
                    </small>
                @endif
            </div>
            @if ($product->isSimple())
                <x-button type="button" class="add-product btn-sm btn-outline-primary" :data-product-id="$product->id">
                    <i class="ti ti-plus"></i>
                    {{ __('Thêm') }}
                </x-button>
            @endif
        </div>
        @if (!$product->isSimple())
            <ul class="ps-5 product-variations">
                @foreach ($product->productVariations as $product_variation)
                    <li>
                        <div class="row">
                            <div class="col">
                                <small class="text-success">
                                    (@foreach ($product_variation->attributeVariations as $attribute_variation)
                                        {{ $attribute_variation->attribute->name . ': ' . $attribute_variation->name }}
                                        @if (!$loop->last)
                                            <span class="me-1">,</span>
                                        @endif
                                    @endforeach)
                                </small>
                                <small>
                                    <span class="mx-1">-</span>
                                    (
                                    @if ($product_variation->promotion_price)
                                        {{ format_price($product_variation->promotion_price) }}
                                        <span> - </span>
                                        <s>{{ format_price($product_variation->price) }}</s>
                                    @else
                                        {{ format_price($product_variation->price) }}
                                    @endif
                                    )
                                </small>
                            </div>
                            <div class="col-auto">
                                <x-button type="button" class="add-product-variation btn-sm btn-outline-primary"
                                    :data-product-id="$product->id" :data-product-variation-id="$product_variation->id">
                                    <i class="ti ti-plus"></i>
                                    {{ __('Thêm') }}
                                </x-button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
