<?php

namespace App\Enums\Post;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Default()
 * @method static static Draft()
 */
final class PostType extends Enum implements LocalizedEnum
{
    const Default = 1;
    // const Video = 2;
}
