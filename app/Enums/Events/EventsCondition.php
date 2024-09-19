<?php

declare(strict_types=1);

namespace App\Enums\Events;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EventsCondition extends Enum implements LocalizedEnum
{
    const no = 0;
    const yes = 1;
}
