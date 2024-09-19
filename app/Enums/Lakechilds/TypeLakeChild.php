<?php

namespace App\Enums\Lakechilds;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static oneLake()
 * @method static static twoLake()
 */
final class TypeLakeChild extends Enum implements LocalizedEnum
{
    const oneLake = 0;
    const twoLake = 1;
}
