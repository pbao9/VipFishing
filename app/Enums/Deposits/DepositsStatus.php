<?php

namespace App\Enums\Deposits;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Pending()
 * @method static static Completed()
 */
final class DepositsStatus extends Enum implements LocalizedEnum
{
    const Pending = 0;
    const Completed = 1;
}
