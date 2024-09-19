<?php

namespace App\Enums\FishingSet;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Sang()
 * @method static static Chieu()
 * @method static static CaNgay()
 * @method static static TuDo()
 */
final class TypeFishingSet extends Enum implements LocalizedEnum
{
    const Sang = 0;
    const Chieu = 1;
    const CaNgay = 2;
    const TuDo = 3;
}
