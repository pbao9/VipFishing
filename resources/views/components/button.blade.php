<button type="{{ $type }}" {{ $attributes->merge(['class' => 'btn']) }}>
    {{ $slot }}
</button>