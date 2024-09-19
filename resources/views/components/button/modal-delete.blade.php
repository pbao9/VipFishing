<button type="button" {{ $attributes->class(['btn', 'btn-danger', 'open-modal-delete'])
->merge([
    'data-bs-toggle' => 'modal',
    'data-bs-target' => '#modalDelete',
]) }}> 
    {{ $title ?? '' }}
    {{ $slot }}
</button>