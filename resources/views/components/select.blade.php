<select {{ $attributes->class(['form-select'])->merge($isRequired()) }}>
    {{ $slot }}
</select>