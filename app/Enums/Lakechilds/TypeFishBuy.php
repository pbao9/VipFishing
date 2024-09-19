<?php

namespace App\Enums\Lakechilds;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Kg()
 * @method static static Con()
 */
final class TypeFishBuy extends Enum implements LocalizedEnum
{
    const Kg = 0;
    const Con = 1;
}
