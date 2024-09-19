<?php

namespace App\Admin\Services\Order;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Admin\Repositories\Order\{OrderRepositoryInterface, OrderDetailRepositoryInterface};
use App\Admin\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Repositories\Product\{ProductRepositoryInterface, ProductVariationRepositoryInterface};
use App\Enums\Product\ProductType;
use App\Enums\Order\{OrderStatus, PaymentMethod};
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    protected $data;
    protected $subTotal;
    protected $orderDetails;
    protected $repository;
    protected $repositoryOrderDetail;
    protected $repositoryUser;
    protected $repositoryProduct;
    protected $repositoryProductVariation;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderDetailRepositoryInterface $repositoryOrderDetail,
        UserRepositoryInterface $repositoryUser,
        ProductRepositoryInterface $repositoryProduct,
        ProductVariationRepositoryInterface $repositoryProductVariation
    )
    {
        $this->repository = $repository;
        $this->repositoryOrderDetail = $repositoryOrderDetail;
        $this->repositoryUser = $repositoryUser;
        $this->repositoryProduct = $repositoryProduct;
        $this->repositoryProductVariation = $repositoryProductVariation;
    }

    public function store(Request $request){
        $this->data = $request->validated();
        $this->data['order']['discount'] = 0;
        $this->data['order']['payment_code'] = uniqid_real(6);
        $this->data['order']['payment_method'] = PaymentMethod::BankTransfer;
        $this->data['order']['status'] = OrderStatus::Processing;
        // dd($this->data, array_unique($this->data['order_detail']['product_id']));
        DB::beginTransaction();
        try {
            if(!$this->makeNewDataOrderDetail()){
                return false;
            }
            $this->data['order']['sub_total'] = $this->data['order']['total'] = $this->subTotal;
            $order = $this->repository->create($this->data['order']);
            $this->storeOrderDetail($order->id, $this->orderDetails);
            DB::commit();
            return $order;
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return false;
        }
    }
    private function makeNewDataOrderDetail(){
        $products = $this->repositoryProduct->getByIdsAndOrderByIds(
            array_unique($this->data['order_detail']['product_id'])
        );
        if($products->count() == 0){
            return false;
        }
        $this->dataOrderDetail($products);
        return true;
    }
    private function dataOrderDetail($products){
        $discount = 1 - $this->repositoryUser->findOrFail($this->data['order']['user_id'])->getDiscountProduct() / 100;
        foreach($this->data['order_detail']['product_id'] as $key => $value){
            $product = $products->firstWhere('id', $value);
            $detail = [
                'product' => $product
            ];
            if($product->isSimple()){
                $unitPrice = $product->promotion_price ?: $product->price;
            }else{
                $product = $product->load(['productVariation' => function($query) use($key){
                    $query->with('attributeVariations')->where('id', $this->data['order_detail']['product_variation_id'][$key]);
                }]);
                $unitPrice = $product->productVariation->promotion_price ?: $product->productVariation->price;
                $detail['productVariation'] = $product->productVariation;
                unset($product->productVariation);
            }
            $unitPrice = $product->is_user_discount ? $unitPrice * $discount : $unitPrice;
            $this->orderDetails[] = [
                'product_id' => $product->id,
                'unit_price' => $unitPrice,
                'product_variation_id' => $this->data['order_detail']['product_variation_id'][$key] ?: null,
                'qty' => $this->data['order_detail']['product_qty'][$key],
                'detail' => $detail
            ];
            $this->subTotal += $unitPrice * $this->data['order_detail']['product_qty'][$key];
        }
    }

    protected function storeOrderDetail($orderId, $data){
        foreach($data as $item){
            $item['order_id'] = $orderId;
            $this->repositoryOrderDetail->create($item);
        }
    }

    public function update(Request $request){
        $this->data = $request->validated();
        
        DB::beginTransaction();
        try {
            $dataOrderDetail = $this->updateOrCreateDataOrderDetail();
            if(!empty($dataOrderDetail)){
                $this->data['order_detail'] = $dataOrderDetail;
                $this->makeNewDataOrderDetail();
                $this->storeOrderDetail($this->data['order']['id'], $this->orderDetails);
            }
            $this->data['order']['sub_total'] = $this->data['order']['total'] = $this->subTotal;
            $order = $this->repository->update($this->data['order']['id'], $this->data['order']);
            DB::commit();
            return $order;
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return false;
        }
    }

    private function updateOrCreateDataOrderDetail(){
        $data = [];
        foreach($this->data['order_detail']['id'] as $key => $value){
            if($value == 0){
                $data['product_id'][] = $this->data['order_detail']['product_id'][$key];
                $data['product_variation_id'][] = $this->data['order_detail']['product_variation_id'][$key];
                $data['product_qty'][] = $this->data['order_detail']['product_qty'][$key];
            }else{
                $orderDetail = $this->repositoryOrderDetail->update($value, [
                    'qty' => $this->data['order_detail']['product_qty'][$key]]
                );
                $this->subTotal += $orderDetail->unit_price * $orderDetail->qty;
            }
        }
        return $data;
    }

    public function delete($id){
        return $this->repository->delete($id);
    }

    public function addProduct(Request $request){
        $data = $request->validated();
        $product = $this->repositoryProduct->findOrFail($data['product_id']);
        $discount = 1 - $this->repositoryUser->findOrFail($data['user_id'])->getDiscountProduct() / 100;
        if($product->type == ProductType::Variable()){
            $product = $product->load(['productVariation' => function($query) use ($data){
                $query->where('id', $data['product_variation_id'] ?? 0)->with('attributeVariations');
            }]);
            if(!$product->productVariation){
                return false;
            }
            if($product->is_user_discount){
                $product->productVariation->price = $product->productVariation->price * $discount;
                $product->productVariation->promotion_price = $product->productVariation->promotion_price * $discount ?: $product->productVariation->promotion_price;
            }
        }else{
            if($product->is_user_discount){
                $product->price = $product->price * $discount;
                $product->promotion_price = $product->promotion_price * $discount ?: $product->promotion_price;
            }
        }

        return $product;
    }
    
    public function calculateTotal(Request $request){
        $data = $request->validated('order_detail');
        $total = 0; $productSimple = []; $productVariation = [];
        foreach($data['product_id'] as $key => $value){
            if($data['product_variation_id'][$key] == 0){
                $productSimple[] = [
                    'id' => $value,
                    'qty' => $data['product_qty'][$key]
                ];
            }else{
                $productVariation[] = [
                    'id' => $data['product_variation_id'][$key],
                    'qty' => $data['product_qty'][$key]
                ];
            }
        }
        $discount = 1 - $this->repositoryUser->findOrFail($request->input('order.user_id'))->getDiscountProduct() / 100;
        if(!empty($productSimple)){
            $total += $this->totalPrice(
                $this->repositoryProduct->getByIdsAndOrderByIds(array_column($productSimple, 'id')),
                array_column($productSimple, 'qty'),
                $discount
            );
        }
        if(!empty($productVariation)){
            $total += $this->totalPrice(
                $this->repositoryProductVariation->getByIdsAndOrderByIdsWithRelations(array_column($productVariation, 'id')),
                array_column($productVariation, 'qty'),
                $discount
            );
        }
        return $total;
    }

    public function totalPrice($collect, $qty, $discount){
        $total = 0;
        $total += $collect->mapWithKeys(function($item, $key) use ($qty, $discount) {
            $price = ($item->promotion_price ?: $item->price) * $qty[$key];

            if($item->is_user_discount || optional($item->product)->is_user_discount){
                $price = ($item->promotion_price ?? $item->price) * $qty[$key] * $discount;
            }
            return [$item->id => $price];
        })->sum();
        return $total;
    }
}