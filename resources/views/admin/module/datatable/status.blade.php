<span @class([
    'badge',
    'bg-red-lt' => \App\Enums\Module\ModuleStatus::ChuaXong == $status,
    'bg-blue-lt' => \App\Enums\Module\ModuleStatus::DaXong == $status,
    'bg-green-lt' => \App\Enums\Module\ModuleStatus::DaDuyet == $status,
])>{{ \App\Enums\Module\ModuleStatus::getDescription($status) }}</span>