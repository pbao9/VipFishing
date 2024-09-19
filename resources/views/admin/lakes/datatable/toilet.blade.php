{{-- <span @class([
    'badge',
    'bg-red-lt' => \App\Enums\Lakes\Toilet::yes == $toilet,
    'bg-blue-lt' => \App\Enums\Lakes\Toilet::no == $toilet,
    ])>{{ \App\Enums\Lakes\Toilet::getDescription($toilet) }}
</span> --}}
@if ($toilet == 1)
    <span class="badge bg-primary">Có</span>
@elseif ($toilet == 2)
    <span class="badge bg-red-lt">Không</span>
@endif
