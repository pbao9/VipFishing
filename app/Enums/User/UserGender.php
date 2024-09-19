<?php

namespace App\Enums\User;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Male()
 * @method static static Female()
 * @method static static Other()
 */
final class UserGender extends Enum implements LocalizedEnum
{
    const Male = 1;
    const Female = 2;
    const Other = 3;
}
