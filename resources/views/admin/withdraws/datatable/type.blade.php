<span @class([
    'badge',
    'bg-pink-lt' => \App\Enums\TransactionHistory\TransactionHistoryType::Withdraw == $type,
    'bg-green-lt' => \App\Enums\TransactionHistory\TransactionHistoryType::Deposit == $type,
    'bg-yellow-lt' => \App\Enums\TransactionHistory\TransactionHistoryType::Commission == $type,
    'bg-purple-lt' => \App\Enums\TransactionHistory\TransactionHistoryType::Compensation == $type,
]) value="{{ $type }}">{{ \App\Enums\TransactionHistory\TransactionHistoryType::getDescription($type) }}</span>