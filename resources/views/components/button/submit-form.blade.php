<button type="button" {{ $attributes->class(['submit-form', 'btn']) }}> 

    @isset($icon)
        {{ $icon }}
    @endisset

    {{ $title ?? '' }}

    {{ $slot }}
    
</button>