<span> - </span>
@foreach ($attribute_variations as $item)
    <span class="text-muted small lh-base">
        {{ $item['name'] }}
        @if (!$loop->last)
            <span>, </span>
        @endif
    </span>
@endforeach