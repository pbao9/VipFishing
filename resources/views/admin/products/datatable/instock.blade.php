<span @class([
    'badge',
    'bg-green-lt' => $in_stock,
    'text-bg-secondary' => !$in_stock
])>{{ $in_stock ? __('Còn hàng') : __('Hết hàng') }}</span>