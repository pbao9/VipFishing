<span @class([
    'badge',
    'bg-pink-lt' => \App\Enums\Deposits\DepositType::moneyDeposit == $type,
    'bg-green-lt' => \App\Enums\Deposits\DepositType::moneyFishs == $type,
    'bg-yellow-lt' => \App\Enums\Deposits\DepositType::moneyCommission == $type,
])
    value="{{ $type }}">{{ \App\Enums\Deposits\DepositType::getDescription($type) }}</span>
