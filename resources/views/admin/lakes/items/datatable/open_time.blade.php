@php
    $openTime = \Carbon\Carbon::parse($open_time);
    $formattedOpenTime = $openTime->format('H:i');
    $openPeriod = $openTime->format('A') === 'AM' ? 'Sáng' : 'Chiều';
@endphp

{{ $formattedOpenTime }} {{ $openPeriod }}
