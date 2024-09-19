@php
    $lakeChildId = $booking['lakechild']['id'];
    $lakeChildName = $booking['lakechild']['name'];
@endphp

Đơn đặt câu mã: <x-link :href="route('admin.bookings.edit', $booking_id)" target="_blank" :title="$booking['id']" /><br>
Hồ: <x-link :href="route('admin.lakes.item.edit', $lakeChildId)" target="_blank" :title="$lakeChildName"/>