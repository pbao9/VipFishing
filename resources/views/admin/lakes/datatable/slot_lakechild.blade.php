<?php
$lakes = App\Models\Lakes::find($id);
$count = $lakes->countLakechilds();
?>


@if ($count % 2 == 0)
    <span class="badge bg-primary-lt">{{ $count . ' Hồ' }}</span>
@else
    <span class="badge bg-cyan-lt">{{ $count . ' Hồ' }}</span>
@endif
<x-link
    :href="route('admin.lakes.item.index', ['lake_id' => $lakes->id])"
    class="d-flex align-items-center text-decoration-none"
>
    {{ __('Xem chi tiết') }}
</x-link>
