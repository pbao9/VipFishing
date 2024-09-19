<?php

namespace App\Api\V1\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckCompatibleTwoArray implements Rule
{
    private $arrayOne;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ids)
    {
        //
        $this->arrayOne = $ids;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        if(gettype($this->arrayOne) === 'array' && gettype($value) === 'array' && count($this->arrayOne) == count($value)){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('id phải tương thích với qty cho từng id đã truyền vào');
    }
}
