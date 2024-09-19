<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoTransactionHistory') }}</h2>

        </div>
        <div class="row card-body">
            <!-- user_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Người dùng') }}:</label>
                    <strong class="mb-2">{{ $transactionHistory->user->fullname }} ({{ $transactionHistory->user->phone }}) - Số dư: {{ number_format($transactionHistory->user->balance->total_balance, 0, ',', '.') }} VNĐ</strong>
                    <!-- <x-select name="user_id" :required="true">
                        @php
                            $titleUser = $transactionHistory->user->fullname . ' - ' . $transactionHistory->user->phone;
                        @endphp
                        <x-select-option :option="$transactionHistory->user_id" :value="$transactionHistory->user_id" :title="$titleUser" />
                    </x-select> -->
                </div>
            </div>
            <!-- transaction_type -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hình thức') }} :</label>
                    <x-select name="transaction_type" :required="true" readonly>
                        @foreach ($transaction_type as $key => $value)
                            @if ($key == $transactionHistory->transaction_type)
                                <x-select-option :option="$transactionHistory->transaction_type" :value="$key" :title="$value" />
                            @endif
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- amount -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tiền') }} :</label>
                    <x-input type="number" min="0" name="amount" :value="$transactionHistory->amount"
                        placeholder="{{ __('Số tiền') }}" readonly="true"/>
                </div>
            </div>

        </div>
    </div>
</div>
