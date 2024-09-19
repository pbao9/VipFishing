<span @class([
    'badge',
    'text-bg-secondary' => !$is_active,
    'text-bg-success' => $is_active
])>{{ $is_active ? 'Hoạt động' : 'Tạm ngưng' }}</span>