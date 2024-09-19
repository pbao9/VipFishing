<span @class([
    'badge',
    'bg-green-lt' => $is_user_discount,
    'text-bg-secondary' => !$is_user_discount
])>{{ $is_user_discount ? __('Có') : __('Không') }}</span>