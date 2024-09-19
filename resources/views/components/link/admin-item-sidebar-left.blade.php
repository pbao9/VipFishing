<a {{ $attributes->class([
    'dropdown-toggle' => $dropdown,
]) }}
    @if ($dropdown) data-bs-toggle="dropdown"
    data-bs-auto-close="false" 
    role="button" 
    aria-expanded="false" @endif>
    {{ $slot }}
</a>
