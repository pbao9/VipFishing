<div class="col-12 col-md-9">
    <div class="row">
        <!-- name -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Tên sản phẩm') }}:</label>
                <x-input name="product[name]" :value="$product->name" :required="true" placeholder="{{ __('Tên sản phẩm') }}" />
            </div>
        </div>

        <!-- name -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mô tả') }}:</label>
                <textarea name="product[desc]" class="ckeditor visually-hidden">{!! $product->desc !!}</textarea>
            </div>
        </div>
        <!-- data -->
        <div class="col-12">
            @include('admin.products.data.data-product')
        </div>
    </div>
</div>
