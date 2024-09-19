<?php

namespace App\Enums\Ranks;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static on()
 * @method static static off()
 */
final class RanksCommissionStatus extends Enum implements LocalizedEnum
{
    const on = 1;
    const off = 2;
}
