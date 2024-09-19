<?php

namespace App\Enums\Lakes;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static yes()
 * @method static static no()
 */
final class Dinner extends Enum implements LocalizedEnum
{
    const yes = 1;
    const no = 2;
}
