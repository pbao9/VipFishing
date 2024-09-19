<?php

namespace App\Enums\Order;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Processing()
 * @method static static Processed()
 * @method static static Completed()
 * @method static static Cancelled()
 */
final class OrderStatus extends Enum implements LocalizedEnum
{
    const Processing = 1;
    const Processed = 2;
    const Completed = 3;
    const Cancelled = 4;
    // const Refunded = 2;
    // const Failed = 2;
}
