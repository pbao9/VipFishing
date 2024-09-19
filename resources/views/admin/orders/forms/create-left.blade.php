<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin đơn hàng') }}</h2>
        </div>
        <div class="row card-body">
            <div class="col-12 col-md-6">
                <h3>{{ __('Thông tin chung') }}</h3>
                <div class="mb-3">
                    <label for="">{{ __('Khách hàng') }}</label>
                    <x-select class="select2-bs5-ajax" name="order[user_id]" :required="true">
                    </x-select>
                </div>
                <div class="mb-3">
                    <label for="">{{ __('Ghi chú') }}:</label>
                    <textarea name="order[note]" class="form-control">{{ old('order.note') }}</textarea>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <h3>{{ __('Thông tin giao hàng') }}</h3>
                <div id="infoShipping">
                    @include('admin.orders.partials.info-shipping')
                </div>
            </div>
            <div class="col-12">
                @include('admin.orders.partials.products')
            </div>
        </div>
    </div>
</div>