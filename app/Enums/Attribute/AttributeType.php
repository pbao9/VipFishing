<?php

namespace App\Enums\Attribute;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Button()
 * @method static static Color()
 */
final class AttributeType extends Enum implements LocalizedEnum
{
    const Button = 1;
    const Color = 2;
}
