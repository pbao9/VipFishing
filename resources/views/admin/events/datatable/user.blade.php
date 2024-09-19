@if(isset($user))
    @php
        $totalBalanceFormatted = number_format($user['balance']['total_balance'], 0, ',', '.') . ' VNĐ';
        $title = "{$user['fullname']} ({$user['phone']}) - Số dư: $totalBalanceFormatted";
    @endphp
    <x-link :href="route('admin.user.edit', $user_id)" target="_blank" :title="$title" />
@endif
