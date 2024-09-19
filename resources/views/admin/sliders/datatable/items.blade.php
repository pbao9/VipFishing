
<div class="d-flex gap-1 align-items-stretch flex-wrap mb-1" style="max-width: 370px;">
    @foreach ($items as $item)
        <x-link :href="route('admin.slider.item.edit', $item['id'])" class="d-flex align-items-center">
            <img src="{{ asset($item['image']) }}" alt="" width="70">
        </x-link>
    @endforeach
</div>
<x-link :href="route('admin.slider.item.index', $id)" :title="__('Các Slider items')" />