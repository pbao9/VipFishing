<span @class([
    'badge',
    'bg-green-lt' => $events_condition,
]) value="{{ $events_condition }}">{{ $events_condition ? 'Có' : 'Không' }}</span>