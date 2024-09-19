<button type="submit" {{ $attributes->merge([ 'class' => 'btn btn-primary']) }}>
    {{ $title }}
    {{ $slot }}
</button>