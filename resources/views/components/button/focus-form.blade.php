<button type="button" {{ $attributes->class(['focus-form', 'btn']) }}> 

    @isset($icon)
        {{ $icon }}
    @endisset

    {{ $title ?? '' }}

    {{ $slot }}
    
</button>