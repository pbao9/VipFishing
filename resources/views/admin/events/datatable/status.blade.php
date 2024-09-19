<span @class([
    'badge',
    'bg-gray-lt' => \App\Enums\Events\EventStatus::NotStarted == $status,
    'bg-blue-lt' => \App\Enums\Events\EventStatus::Ongoing == $status,
    'bg-yellow-lt' => \App\Enums\Events\EventStatus::Paused == $status,
    'bg-pink-lt' => \App\Enums\Events\EventStatus::Cancelled == $status,
    'bg-red-lt' => \App\Enums\Events\EventStatus::Finished == $status,
]) value="{{ $status }}">{{ \App\Enums\Events\EventStatus::getDescription($status) }}</span>