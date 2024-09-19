<a {{ $attributes }}>
    
    {{ $slot }}

    @isset($title)
        <span>{{ $title }}</span>
    @endisset

    @isset($append)
        {{ $append }}
    @endisset
</a>