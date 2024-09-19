{{-- <span @class([
    'badge',
    'bg-red-lt' => \App\Enums\Lakes\Lunch::yes == $lunch,
    'bg-blue-lt' => \App\Enums\Lakes\Lunch::no == $lunch,
    ])>{{ \App\Enums\Lakes\Lunch::getDescription($lunch) }}
</span> --}}
@if ($lunch == 1)
    <span class="badge bg-primary">Có</span>
@else
    <span class="badge bg-red-lt">Không</span>
@endif
