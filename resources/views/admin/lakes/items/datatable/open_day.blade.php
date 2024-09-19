@php
    // Kiểm tra xem biến có được truyền không
    if (!isset($open_day)) {
        $open_day = [];
    }

    // Chuyển đổi JSON hoặc mảng thành một mảng ngày
    $openDays = is_array($open_day) ? $open_day : json_decode($open_day, true);

    // Tạo một mảng với tên ngày trong tuần tương ứng
    $daysOfWeek = [
        1 => 'T2',
        2 => 'T3',
        3 => 'T4',
        4 => 'T5',
        5 => 'T6',
        6 => 'T7',
        7 => 'CN'
    ];

    // Lọc và lấy tên ngày tương ứng từ mảng
    $dayNames = array_map(function ($day) use ($daysOfWeek) {
        return $daysOfWeek[$day] ?? null;
    }, $openDays);
@endphp

{{-- Hiển thị các ngày mở cửa --}}
{{ implode(', ', array_filter($dayNames)) }}
