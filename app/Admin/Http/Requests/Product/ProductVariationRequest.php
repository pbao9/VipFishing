<?php

namespace App\Admin\Http\Requests\Product;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Product\ProductVariationAction;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductVariationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        if($this->routeIs('admin.product.variation.check') || $this->routeIs('admin.product.variation.create')){
            $this->validate['product_attribute.attribute_id'] = ['required', 'array'];
            $this->validate['product_attribute.attribute_id.*'] = ['required', 'exists:App\Models\Attribute,id'];
            $this->validate['product_attribute.attribute_variation_id'] = ['required', 'array'];
            $this->validate['product_attribute.attribute_variation_id.*'] = ['required', 'array'];
            $this->validate['product_attribute.attribute_variation_id.*.*'] = ['required', 'exists:App\Models\AttributeVariation,id'];
            if($this->routeIs('admin.product.variation.create')){
                $this->validate['variation_action'] = ['required', new EnumValue(ProductVariationAction::class, false)];
            }
        }
        return $this->validate;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['required', 'string'],
            'desc' => ['nullable'],
            'categories_id.*' => ['required', 'exists:App\Models\Category,id'],
            'avatar' => ['required'],
            'type' => ['required', new EnumValue(ProductType::class, false)],
            'price' => ['nullable', 'numeric'],
            'promotion_price' => ['nullable', 'numeric'],
            'in_stock' => ['required', 'boolean'],
            'gallery' => ['nullable']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\User,id'],
            // 'username' => [
            //     'required', 
            //     'string', 'min:6', 'max:50',
            //     'unique:App\Models\User,username,'.$this->id, 
            //     'regex:/^[A-Za-z0-9_-]+$/',
            //     function ($attribute, $value, $fail) {
            //         if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
            //             $fail('The '.$attribute.' cannot be a common keyword.');
            //         }
            //     },
            // ],
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\User,email,'.$this->id],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone,'.$this->id],
            'address' => ['nullable'],
            'gender' => ['required', new EnumValue(UserGender::class, false)],
            'password' => ['nullable', 'string', 'confirmed'],
            'vip' => ['required', new EnumValue(UserVip::class, false)]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if($this->routeIs('admin.product.variation.check')){
            $errors = (new ValidationException($validator))->errors();
            $viewError = view('admin.products.data.partials.no-variation')->render();
            throw new HttpResponseException(
                response()->json([
                    'errors' => $errors,
                    'viewError' => $viewError
                ], 422)
            );
        }
    }
}