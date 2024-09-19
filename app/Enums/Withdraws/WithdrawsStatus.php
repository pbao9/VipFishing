<?php

namespace App\Enums\Withdraws;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Pending()
 * @method static static Completed()
 */
final class WithdrawsStatus extends Enum implements LocalizedEnum
{
    const Pending = 0;
    const Completed = 1;
    const Declined = 2;
}
