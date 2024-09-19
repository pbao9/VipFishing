<div class="col-12 col-md-3">
    @php
        $isReadonly = false;
        if ($deposits->status == 1) {
            $isReadonly = true;
        }
    @endphp
    @if (!$isReadonly)
        <div class="card mb-3">
            <div class="card-header">
                {{ __('Đăng') }}
            </div>
            <div class="card-body p-2 d-flex align-items-center justify-content-between flex-wrap">
                <x-button.submit :title="__('Cập nhật')" />
                <x-button.modal-delete data-route="{{ route('admin.deposits.delete', $deposits->id) }}"
                    :title="__('Xóa')" />
                <x-link :href="route('admin.deposits.create')" class="btn btn-green my-1"><i
                        class="ti ti-plus"></i>{{ __('Thêm') }}</x-link>
            </div>
        </div>
    @endif
    <!-- status -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Loại nạp tiền') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <span @class([
                'badge',
                'bg-yellow-lt' =>
                    \App\Enums\Deposits\DepositType::moneyDeposit == $deposits->type,
                'bg-purple-lt' =>
                    \App\Enums\Deposits\DepositType::moneyFishs == $deposits->type,
            ])
                value="{{ $deposits->type }}">{{ \App\Enums\Deposits\DepositType::getDescription($deposits->type) }}</span>

        </div>
    </div>

    <!-- status -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-select name="status" :required="true">
                @if ($isReadonly)
                    <x-select-option :option="$deposits->status" :value="$deposits->status" :title="__('Đã hoàn thành')" />
                @else
                    @foreach ($status as $key => $value)
                        <x-select-option :option="$deposits->status" :value="$key" :title="$value" />
                    @endforeach
                @endif
            </x-select>
        </div>
    </div>

    <!-- license -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh chứng từ') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder :value="$deposits->license" name="license" showImage="license" :readonly="$isReadonly" />
        </div>
    </div>
</div>
