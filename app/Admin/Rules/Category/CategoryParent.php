<?php

namespace App\Admin\Rules\Category;

use Illuminate\Contracts\Validation\Rule;

class CategoryParent implements Rule
{
    private $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        //
        $this->id = $id;
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
        return $value !== $this->id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Chọn danh mục cha không hợp lệ');
    }
}
