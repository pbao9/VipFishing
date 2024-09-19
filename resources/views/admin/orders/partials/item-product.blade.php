<tr @class([
    'item-product',
    'product-'.$order_detail->detail['product']['id'],
    'product-variation-'.($order_detail->detail['productVariation']['id'] ?? '') => isset($order_detail->detail['productVariation']['id'])
]) data-product-id="{{ $order_detail->detail['product']['id'] }}" data-product-variation-id="{{ $order_detail->detail['productVariation']['id'] ?? '' }}">
    <td class="align-middle">
        <span class="cursor-pointer remove-item-product" data-id="{{ $order_detail->id }}"><i class="ti ti-x"></i></span>
        <x-input type="hidden" name="order_detail[id][]" :value="$order_detail->id" />
        <x-input type="hidden" name="order_detail[product_id][]" :value="$order_detail->detail['product']['id']" />
        <x-input type="hidden" name="order_detail[product_variation_id][]" :value="$order_detail->detail['productVariation']['id'] ?? 0" />
    </td>
    <td class="align-middle">
        <x-link :href="route('admin.product.edit', $order_detail->detail['product']['id'])" target="_blank" :title="$order_detail->detail['product']['name']" />
        @includeUnless($order_detail->detail['product']['type'] == \App\Enums\Product\ProductType::Simple, 'admin.orders.partials.product-variation', [
            'attribute_variations' => $order_detail->detail['productVariation']['attribute_variations'] ?? []
        ])
    </td>
    <td class="text-center">
        <x-input type="number" name="order_detail[product_qty][]" :value="$order_detail->qty" min="1" autocomplete="off"
        :data-parsley-number-message="__('Trường này phải là số.')"
        :data-parsley-min-message="__('Giá trị phải lớn hơn 1.')"/>
    </td>
    <td class="unit-price align-middle">{{ format_price($order_detail->unit_price) }}</td>
    <td class="total-price align-middle">{{ format_price($order_detail->unit_price * $order_detail->qty) }}</td>
</tr>