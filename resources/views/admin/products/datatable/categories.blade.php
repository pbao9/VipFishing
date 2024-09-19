<span>
    @foreach ($categories as $item)
        @if ($loop->last)
            <x-link :href="route('admin.category.edit', $item['id'])" :title="$item['name']" />
        @else
            <x-link :href="route('admin.category.edit', $item['id'])" :title="$item['name']" />,&nbsp;
        @endif
    @endforeach
</span>