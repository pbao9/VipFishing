<div id="inventory" class="tab-pane p-3" role="tabpanel" aria-labelledby="tabInventory">
    <div class="row">
        <label class="col-5 col-form-label" for="">{{ __('Trạng thái kho hàng') }}</label>
        <div class="col">
            <x-select name="product[in_stock]" class="form-select">
                <x-select-option value="1" :title="__('Còn hàng')" />
                <x-select-option :option="isset($product->in_stock) ? $product->in_stock ?: '0' : ''" value="0" :title="__('Hết hàng')" />
            </x-select>
        </div>
    </div>
</div>