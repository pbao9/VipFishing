<?php

namespace App\Enums\Lakes;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static active()
 * @method static static inactive()
 * @method static static close()
 */
final class StatusLake extends Enum implements LocalizedEnum
{
    const active = 1;
    const inactive = 2;
    const close = 3;
}
