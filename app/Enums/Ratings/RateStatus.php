<?php

namespace App\Enums\Ratings;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RateStatus extends Enum implements LocalizedEnum
{
    const satisfied = 0;
    const notSatisfied = 1;
}
