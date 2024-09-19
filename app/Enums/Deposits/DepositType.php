<?php

declare(strict_types=1);

namespace App\Enums\Deposits;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static moneyDeposit()
 * @method static static moneyFishs()
 */
final class DepositType extends Enum implements LocalizedEnum
{
    const moneyDeposit = 0;
    const moneyFishs = 1;
    const moneyCommission = 2;

    public function badge(): string
    {
        return match ($this) {
            self::moneyDeposit => 'badge-success',
            self::moneyFishs => 'badge-info',
            self::moneyCommission => 'badge-pink'
        };
    }
}
