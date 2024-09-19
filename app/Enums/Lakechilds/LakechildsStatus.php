<?php

namespace App\Enums\Lakechilds;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static active()
 * @method static static closed()
 */
final class LakechildsStatus extends Enum implements LocalizedEnum
{
    const active = 1;
    const inactive = 2;
    const closed = 3;
}
