<span @class([
    'badge',
    'bg-green-lt' => \App\Enums\Post\PostStatus::Published == $status,
])>{{ \App\Enums\Post\PostStatus::getDescription($status) }}</span>