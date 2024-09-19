@php
    $closeTime = \Carbon\Carbon::parse($close_time);
    $formattedCloseTime = $closeTime->format('H:i');
    $closePeriod = $closeTime->format('A') === 'AM' ? 'Sáng' : 'Chiều';
    
@endphp
{{ $formattedCloseTime }} {{ $closePeriod }}

