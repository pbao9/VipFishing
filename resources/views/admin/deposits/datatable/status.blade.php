<span @class([
    'badge',
    'bg-green-lt' => \App\Enums\Deposits\DepositsStatus::Completed == $status,
    'bg-yellow-lt' => \App\Enums\Deposits\DepositsStatus::Pending == $status,
]) value="{{ $status }}">{{ \App\Enums\Deposits\DepositsStatus::getDescription($status) }}</span>