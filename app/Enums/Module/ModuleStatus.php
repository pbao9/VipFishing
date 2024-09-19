<?php

namespace App\Enums\Module;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static ChuaXong()
 * @method static static DaXong()
 * @method static static DaDuyet()
 */
final class ModuleStatus extends Enum implements LocalizedEnum
{
    const ChuaXong = 1;
    const DaXong = 2;
    const DaDuyet = 3;
}
