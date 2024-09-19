<span @class([
    'badge',
    'bg-yellow-lt' => \App\Enums\Order\OrderStatus::Processing == $status,
    'bg-lime-lt' => \App\Enums\Order\OrderStatus::Processed == $status,
    'bg-green-lt' => \App\Enums\Order\OrderStatus::Completed == $status,
    'bg-red-lt' => \App\Enums\Order\OrderStatus::Cancelled == $status,
])>{{ \App\Enums\Order\OrderStatus::getDescription($status) }}</span>