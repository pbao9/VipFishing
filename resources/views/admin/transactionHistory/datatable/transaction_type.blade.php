<span @class([
    'badge',
    'bg-pink-lt' =>
        \App\Enums\TransactionHistory\TransactionHistoryType::Withdraw ==
        $transaction_type,
    'bg-green-lt' =>
        \App\Enums\TransactionHistory\TransactionHistoryType::Deposit ==
        $transaction_type,
    'bg-yellow-lt' =>
        \App\Enums\TransactionHistory\TransactionHistoryType::Commission ==
        $transaction_type,
    'bg-purple-lt' =>
        \App\Enums\TransactionHistory\TransactionHistoryType::Compensation ==
        $transaction_type,
    'bg-blue-lt' =>
        \App\Enums\TransactionHistory\TransactionHistoryType::Booking ==
        $transaction_type,
    'bg-orange-lt' =>
        \App\Enums\TransactionHistory\TransactionHistoryType::Refund ==
        $transaction_type,
])
    value="{{ $transaction_type }}">{{ \App\Enums\TransactionHistory\TransactionHistoryType::getDescription($transaction_type) }}</span>
