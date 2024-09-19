<span @class([
    'badge',
    'bg-red-lt' => \App\Enums\FishingRating\FishingRatingType::Sang == $type_fishing_rating,
    'bg-blue-lt' => \App\Enums\FishingRating\FishingRatingType::Chieu == $type_fishing_rating,
    'bg-green-lt' => \App\Enums\FishingRating\FishingRatingType::CaNgay == $type_fishing_rating,
    'bg-yellow-lt' => \App\Enums\FishingRating\FishingRatingType::TuDo == $type_fishing_rating,
    ])>{{ \App\Enums\FishingRating\FishingRatingType::getDescription($type_fishing_rating) }}
</span>