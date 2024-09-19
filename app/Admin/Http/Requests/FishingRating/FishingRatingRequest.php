<?php

namespace App\Admin\Http\Requests\FishingRating;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\FishingRating\FishingRatingType;

class FishingRatingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
			'type_fishing_rating' => ['required', new EnumValue(FishingRatingType::class, false)],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\FishingRating, id'],
			'type_fishing_rating' => ['required', new EnumValue(FishingRatingType::class, false)],
        ];
    }
}
