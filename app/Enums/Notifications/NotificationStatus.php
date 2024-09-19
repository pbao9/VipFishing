<?php

namespace App\Enums\Notifications;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Seen()
 * @method static static Not_Seen()
 */
final class NotificationStatus extends Enum implements LocalizedEnum
{
    const Seen = 1;
    const Not_Seen = 2;
}
