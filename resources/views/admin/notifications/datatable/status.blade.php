<span @class([
    'badge',
    'bg-green-lt' => \App\Enums\Notifications\NotificationStatus::Seen == $status,
    'bg-yellow-lt' => \App\Enums\Notifications\NotificationStatus::Not_Seen == $status,
]) value="{{ $status }}">{{ \App\Enums\Notifications\NotificationStatus::getDescription($status) }}</span>