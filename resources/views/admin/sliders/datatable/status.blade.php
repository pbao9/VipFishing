<span @class([
    'badge',
    'bg-green-lt' => \App\Enums\Slider\SliderStatus::Active == $status,
])>{{ \App\Enums\Slider\SliderStatus::getDescription($status) }}</span>