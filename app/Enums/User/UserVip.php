<?php

namespace App\Enums\User;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Default()
 * @method static static Bronze()
 * @method static static Silver()
 * @method static static Gold()
 * @method static static Diamond()
 */
final class UserVip extends Enum implements LocalizedEnum
{
    const Default = 1;
    const Bronze = 2;
    const Silver = 3;
    const Gold = 4;
    const Diamond = 5;
}
