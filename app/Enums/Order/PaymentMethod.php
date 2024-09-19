<?php

namespace App\Enums\Order;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static BankTransfer()
 * @method static static CashOnDelivery()
 */
final class PaymentMethod extends Enum implements LocalizedEnum
{
    const BankTransfer = 1;
    // const CashOnDelivery = 2;
}
