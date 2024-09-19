<?php

namespace App\Enums\TransactionHistory;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Deposit()
 * @method static static Withdraw()
 * @method static static Commission()
 * @method static static Compensation()
 * @method static static Booking()
 * @method static static Refund()
 */
final class TransactionHistoryType extends Enum implements LocalizedEnum
{
    const Deposit = 0;
    const Withdraw = 1;
    const Commission = 2;
    const Compensation = 3;
    const Booking = 4;
    const Refund = 5;
}
