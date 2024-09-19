<?php

namespace App\Enums\Events;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static NotStarted()
 * @method static static Ongoing()
 * @method static static Paused()
 * @method static static Cancelled()
 * @method static static Finished()
 */
final class EventStatus extends Enum implements LocalizedEnum
{
    const NotStarted = 0;
    const Ongoing = 1;
    const Paused = 2;
    const Cancelled = 3;
    const Finished = 4;
}
