<?php

namespace App\Admin\Http\Requests\Product;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\Product\ProductType;

class ProductRequest extends BaseRequest
{
    public function methodGet(){
        return [

        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        $this->validate = [
            'product.name' => ['required', 'string'],
            'product.desc' => ['nullable'],
            'categories_id' => ['nullable', 'array'],
            'categories_id.*' => ['nullable', 'exists:App\Models\Category,id'],
            'product.avatar' => ['required'],
            'product.type' => ['required', new EnumValue(ProductType::class, false)],
            'product.price' => ['nullable', 'numeric'],
            'product.promotion_price' => ['nullable', 'numeric'],
            'product.in_stock' => ['required', 'boolean'],
            'product.is_active' => ['required', 'boolean'],
            'product.is_user_discount' => ['required', 'boolean'],
            'product.is_earning_point' => ['required', 'boolean'],
            'product.gallery' => ['nullable']
        ];
        if($this->input('product.type') == ProductType::Simple){
            $this->validate['product.price'] = ['required', 'numeric'];
        }elseif($this->input('product.type') == ProductType::Variable){
            $this->validate['product_attribute.attribute_id'] = ['required', 'array'];
            $this->validate['product_attribute.attribute_id.*'] = ['required', 'exists:App\Models\Attribute,id'];
            $this->validate['product_attribute.attribute_variation_id'] = ['required', 'array'];
            $this->validate['product_attribute.attribute_variation_id.*'] = ['required', 'array'];
            $this->validate['product_attribute.attribute_variation_id.*.*'] = ['required', 'exists:App\Models\AttributeVariation,id'];
            $this->validate['products_variations.attribute_variation_id'] = ['nullable', 'array'];
            if($this->input('products_variations.attribute_variation_id') && count($this->input('products_variations.attribute_variation_id')) > 0){
                $this->validate['products_variations.id'] = ['required', 'array'];
                $this->validate['products_variations.id.*'] = ['required', 'integer'];
                $this->validate['products_variations.attribute_variation_id'] = ['nullable', 'array'];
                $this->validate['products_variations.attribute_variation_id.*'] = ['required', 'array'];
                $this->validate['products_variations.attribute_variation_id.*.*'] = ['required', 'exists:App\Models\AttributeVariation,id'];
                $this->validate['products_variations.image'] = ['required', 'array'];
                $this->validate['products_variations.price'] = ['required', 'array'];
                $this->validate['products_variations.price.*'] = ['required', 'numeric'];
                $this->validate['products_variations.promotion_price'] = ['nullable', 'array'];
                $this->validate['products_variations.promotion_price.*'] = ['nullable', 'numeric'];
            }
        }
        return $this->validate;
    }

    protected function methodPut()
    {
        $this->validate = [
            'product.id' => ['required', 'exists:App\Models\Product,id'],
            'product.name' => ['required', 'string'],
            'product.desc' => ['nullable'],
            'categories_id' => ['nullable', 'array'],
            'categories_id.*' => ['nullable', 'exists:App\Models\Category,id'],
            'product.avatar' => ['required'],
            'product.type' => ['required', new EnumValue(ProductType::class, false)],
            'product.price' => ['nullable', 'numeric'],
            'product.promotion_price' => ['nullable', 'numeric'],
            'product.in_stock' => ['required', 'boolean'],
            'product.is_active' => ['required', 'boolean'],
            'product.is_user_discount' => ['required', 'boolean'],
            'product.is_earning_point' => ['required', 'boolean'],
            'product.gallery' => ['nullable'],
        ];
        if($this->input('product.type') == ProductType::Simple){
            $this->validate['product.price'] = ['required', 'numeric'];
        }elseif($this->input('product.type') == ProductType::Variable){
            $this->validate['product_attribute.attribute_id'] = ['required', 'array'];
            $this->validate['product_attribute.attribute_id.*'] = ['required', 'exists:App\Models\Attribute,id'];
            $this->validate['product_attribute.attribute_variation_id'] = ['required', 'array'];
            $this->validate['product_attribute.attribute_variation_id.*'] = ['required', 'array'];
            $this->validate['product_attribute.attribute_variation_id.*.*'] = ['required', 'exists:App\Models\AttributeVariation,id'];
            $this->validate['products_variations.attribute_variation_id'] = ['nullable', 'array'];
            if($this->input('products_variations.attribute_variation_id') && count($this->input('products_variations.attribute_variation_id')) > 0){
                $this->validate['products_variations.id'] = ['required', 'array'];
                $this->validate['products_variations.id.*'] = ['required', 'integer'];
                $this->validate['products_variations.attribute_variation_id'] = ['nullable', 'array'];
                $this->validate['products_variations.attribute_variation_id.*'] = ['required', 'array'];
                $this->validate['products_variations.attribute_variation_id.*.*'] = ['required', 'exists:App\Models\AttributeVariation,id'];
                $this->validate['products_variations.image'] = ['required', 'array'];
                $this->validate['products_variations.price'] = ['required', 'array'];
                $this->validate['products_variations.price.*'] = ['required', 'numeric'];
                $this->validate['products_variations.promotion_price'] = ['nullable', 'array'];
                $this->validate['products_variations.promotion_price.*'] = ['nullable', 'numeric'];
            }
        }
        return $this->validate;
    }
}