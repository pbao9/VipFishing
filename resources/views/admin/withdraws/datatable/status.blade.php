<span @class([
    'badge',
    'bg-green-lt' => \App\Enums\Withdraws\WithdrawsStatus::Completed == $status,
    'bg-yellow-lt' => \App\Enums\Withdraws\WithdrawsStatus::Pending == $status,
]) value="{{ $status }}">{{ \App\Enums\Withdraws\WithdrawsStatus::getDescription($status) }}</span>