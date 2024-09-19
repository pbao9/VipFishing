<span @class([
    'badge',
    'bg-green-lt' => \App\Enums\Ranks\RanksCommissionStatus::on == $stauts_comission,
    'bg-red-lt' => \App\Enums\Ranks\RanksCommissionStatus::off == $stauts_comission,
]) value="{{ $stauts_comission }}">{{ \App\Enums\Ranks\RanksCommissionStatus::getDescription($stauts_comission) }}</span>