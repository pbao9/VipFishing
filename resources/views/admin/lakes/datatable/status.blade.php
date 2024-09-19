 <span @class([
    'badge',
    'bg-success-lt' => \App\Enums\Lakes\StatusLake::active == $status,
    'bg-warning-lt' => \App\Enums\Lakes\StatusLake::inactive == $status,
        'bg-danger-lt' => \App\Enums\Lakes\StatusLake::close == $status,
    ])>{{ \App\Enums\Lakes\StatusLake::getDescription($status) }}
</span>
