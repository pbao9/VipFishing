<span @class([
    'badge',
    'bg-success-lt' =>
        \App\Enums\Lakechilds\LakechildsStatus::active == $status,
    'bg-warning-lt' =>
        \App\Enums\Lakechilds\LakechildsStatus::inactive == $status,
    'bg-danger-lt' => \App\Enums\Lakechilds\LakechildsStatus::closed == $status,
])>{{ \App\Enums\Lakechilds\LakechildsStatus::getDescription($status) }}
</span>
