<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin đơn hàng #:id', ['id' => $order->id]) }}</h2>
        </div>
        <div class="row card-body">
            <div class="col-12 col-md-6">
                <h3>{{ __('Thông tin chung') }}</h3>
                <p>{{ __('Mã đơn hàng: #:id', ['id' => $order->id]) }}</p>
                <div class="mb-3">
                    <label for="">{{ __('Khách hàng') }}</label>
                    <x-select class="select2-bs5-ajax" name="order[user_id]" :required="true">
                        <x-select-option :option="$order->user_id" :value="$order->user_id" :title="optional($order->user)->fullname"/>
                    </x-select>
                </div>
                <div class="mb-3">
                    <label for="">{{ __('Trạng thái') }}:</label>
                    <x-select name="order[status]" :required="true">
                        @foreach ($status as $key => $value)
                            <x-select-option :option="$order->status->value" :value="$key" :title="$value"/>
                        @endforeach
                    </x-select>
                </div>
                <div class="mb-3">
                    <label for="">{{ __('Ghi chú') }}:</label>
                    <textarea name="order[note]" class="form-control">{{ $order->note }}</textarea>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <h3>{{ __('Thông tin giao hàng') }}</h3>
                <div id="infoShipping">
                    @include('admin.orders.partials.info-shipping', [
                        'customer_fullname' => $order->customer_fullname,
                        'customer_email' => $order->customer_email,
                        'customer_phone' => $order->customer_phone,
                        'shipping_address' => $order->shipping_address,
                    ])
                </div>
            </div>
            <div class="col-12">
                @include('admin.orders.partials.products')
            </div>
        </div>
    </div>
</div>