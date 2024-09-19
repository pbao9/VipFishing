{{-- <span @class([
    'badge',
    'bg-red-lt' => \App\Enums\Lakes\Dinner::yes == $dinner,
    'bg-blue-lt' => \App\Enums\Lakes\Dinner::no == $dinner,
    ])>{{ \App\Enums\Lakes\Dinner::getDescription($dinner) }}
</span> --}}
@if ($dinner == 1)
    <span class="badge bg-primary">Có</span>
@else
    <span class="badge bg-red-lt">Không</span>
@endif
