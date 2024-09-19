<?php

namespace App\Enums\Product;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Simple()
 * @method static static Variable()
 */
final class ProductType extends Enum implements LocalizedEnum
{
    const Simple = 1;
    const Variable = 2;
}
