<?php

namespace App\Enums\Slider;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Active()
 * @method static static Inactive()
 */
final class SliderStatus extends Enum implements LocalizedEnum
{
    const Active = 1;
    const Inactive = 2;
}
