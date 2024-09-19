<p>
    @foreach ($variations as $item)
        @if ($loop->last)
            {{ $item['name'] }}
        @else
            {{ $item['name'] }},&nbsp;
        @endif
    @endforeach
</p>
<x-link :href="route('admin.attribute.variation.index', $id)" :title="__('Cấu hình các biến thể')" />
