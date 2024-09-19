<?php

namespace App\Enums\Lakechilds;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Monday()
 * @method static static Tuesday()
 * @method static static Wednesday()
 * @method static static Thursday()
 * @method static static Friday()
 * @method static static Saturday()
 * @method static static Sunday()
 */
final class DayOfWeek extends Enum implements LocalizedEnum
{
    const Monday = 1;
    const Tuesday = 2;
    const Wednesday = 3;
    const Thursday = 4;
    const Friday = 5;
    const Saturday = 6;
    const Sunday = 7;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Monday:
                return __('Thứ Hai');
            case self::Tuesday:
                return __('Thứ Ba');
            case self::Wednesday:
                return __('Thứ Tư');
            case self::Thursday:
                return __('Thứ Năm');
            case self::Friday:
                return __('Thứ Sáu');
            case self::Saturday:
                return __('Thứ Bảy');
            case self::Sunday:
                return __('Chủ Nhật');
            default:
                return self::getKey($value);
        }
    }
}
