<?php

namespace App\Enums\Setting;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Text()
 * @method static static Number()
 * @method static static Email()
 * @method static static Phone()
 * @method static static Password()
 * @method static static Textarea()
 * @method static static Image()
 * @method static static Gallery()
 * @method static static Checkbox()
 * @method static static Radio()
 */
final class SettingTypeInput extends Enum implements LocalizedEnum
{
    const Text = 1;
    const Number = 2;
    const Email = 3;
    const Phone = 4;
    const Password = 5;
    const Textarea = 6;
    const Image = 7;
    const Gallery = 8;
    const Checkbox = 9;
    const Radio = 10;
}
