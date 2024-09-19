@if ($type == \App\Enums\Product\ProductType::Simple)
    @if ($promotion_price)
        <span class="promotion-price">{{ format_price($promotion_price) }}</span>
        <span class="mx-1">-</span>
        <span class="price"><s>{{ format_price($price) }}</s></span>
    @else
        <span class="price">{{ format_price($price) }}</span>
    @endif
@elseif(count($product_variations) > 0)
    @php($price_variation = array_column($product_variations, 'price'))
    @if (count($price_variation) > 1)
        <span class="price">{{ format_price(min($price_variation)) }}</span>
        <span class="mx-1">-</span>
        <span class="price">{{ format_price(max($price_variation)) }}</span>
    @else
        @if ($product_variations[0]['promotion_price'])
            <span class="promotion-price">{{ format_price($product_variations[0]['promotion_price']) }}</span>
            <span class="mx-1">-</span>
            <span class="price"><s>{{ format_price($product_variations[0]['price']) }}</s></span>
        @else
            <span class="price">{{ format_price($product_variations[0]['price']) }}</span>
        @endif
    @endif
@endif
