<?php

namespace App\Admin\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductEditResource extends JsonResource
{
    private $arrProductAttributesId;
    private $arrProductAttributes;
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'product';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $productAttributes = $this->productAttributes($this->productAttributes);
        $productVariations = $this->productVariations($this->productVariations);
        $data = [
            'id' => $this->id,
            'type' => $this->type,
            'name' => $this->name,
            'price' => $this->price,
            'promotion_price' => $this->promotion_price,
            'in_stock' => $this->in_stock,
            'is_active' => $this->is_active,
            'is_user_discount' => $this->is_user_discount,
            'is_earning_point' => $this->is_earning_point,
            'avatar' => $this->avatar,
            'gallery' => $this->gallery,
            'desc' => $this->desc,
            'categories' => $this->categories,
            'productAttributes' => $productAttributes,
            'productVariations' => $productVariations,
            'arrProductAttributesId' => $this->arrProductAttributesId,
            'arrProductAttributes' => $this->arrProductAttributes,
        ];
        return $data;
        // dd($data);
    }

    private function productAttributes($data){
        $data = $data->map(function($productAttribute) {

            $this->arrProductAttributesId[] = $productAttribute->only('attribute_id')['attribute_id'];

            $this->arrProductAttributes[] = $productAttribute->attribute->variations->mapWithKeys(function($item) {
                return [$item->id => $item->name];
            });

            foreach($productAttribute->attributeVariations as $item){
                $arr[] = $item->only('id')['id'];
            }

            unset($productAttribute->attributeVariations);

            $productAttribute->attributeVariations = $arr;

            return $productAttribute;
        });
        return $data;
    }

    private function productVariations($data){
        $data = $data->map(function($productVariation) {
            foreach($productVariation->attributeVariations as $item){
                $arr[] = $item->only('id')['id'];
            }

            unset($productVariation->attributeVariations);

            $productVariation->attributeVariations = $arr;

            return $productVariation;
        });
        return $data;
    }
}
