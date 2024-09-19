@php
    $fishId = $variationfish['fish']['id'];
    $fishName = $variationfish['fish']['name'];
    $fishDensity = $variationfish['fish_density'];
@endphp

Mật độ cá: <x-link :href="route('admin.fishs.item.edit', $variationFishs_id)" target="_blank" :title="$fishDensity . ' kg/m2'" /><br>
Cá: <x-link :href="route('admin.fishs.edit', $fishId)" target="_blank" :title="$fishName"/>
