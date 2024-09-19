<?php

namespace App\Enums\Bookings;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Unpaid()
 * @method static static Paid()
 * @method static static Fishing()
 * @method static static Completed()
 * @method static static Cancelled()
 */
final class BookingsStatus extends Enum implements LocalizedEnum
{
    const Unpaid = 0;
    const Paid = 1;
    const Fishing = 2;
    const Completed = 3;
    const Cancelled = 4;
}