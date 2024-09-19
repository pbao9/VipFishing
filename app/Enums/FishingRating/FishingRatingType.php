<?php

namespace App\Enums\FishingRating;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Sang()
 * @method static static Chieu()
 * @method static static CaNgay()
 * @method static static TuDo()
 */
final class FishingRatingType extends Enum implements LocalizedEnum
{
    const Sang = 0;
    const Chieu = 1;
    const CaNgay = 2;
    const TuDo = 3;
}
