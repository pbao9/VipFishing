<span @class([
    'badge',
    'bg-pink-lt' => \App\Enums\Bookings\BookingsStatus::Unpaid == $status,
    'bg-blue-lt' => \App\Enums\Bookings\BookingsStatus::Paid == $status,
    'bg-yellow-lt' => \App\Enums\Bookings\BookingsStatus::Fishing == $status,
    'bg-green-lt' => \App\Enums\Bookings\BookingsStatus::Completed == $status,
    'bg-red-lt' => \App\Enums\Bookings\BookingsStatus::Cancelled == $status,
]) value="{{ $status }}">{{ \App\Enums\Bookings\BookingsStatus::getDescription($status) }}</span>