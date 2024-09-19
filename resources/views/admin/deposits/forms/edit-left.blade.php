<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoDeposit') }}</h2>
            @php
                $isReadonly = false;
                if ($deposits->status == 1) {
                    echo "<span class='badge bg-green-lt'>Đã hoàn tất giao dịch nạp</span>";
                    $isReadonly = true;
                }
            @endphp
        </div>
        <div class="row card-body">
            <!-- user_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Người dùng') }}:</label>
                    <div class="mb-3">
                        <p class="mb-1">
                            <strong>{{ $deposits->user->fullname }}</strong>
                            <span class="text-muted">({{ $deposits->user->phone }})</span>
                            <strong> - Số dư:</strong>
                            <strong
                                class="text-success">{{ number_format($deposits->user->balance->total_balance, 0, ',', '.') }}
                                VNĐ</strong>
                        </p>
                        <p class="mb-1">
                            <strong>Thông tin ngân hàng:</strong>
                            <strong class="text-primary">{{ $deposits->user->bank->name }}</strong>
                        </p>
                        <p class="mb-1">
                            <strong>Số tài khoản:</strong>
                            <strong class="text-primary">{{ $deposits->user->bank_number }}</strong>
                        </p>
                    </div>
                </div>
            </div>
            <!-- amount -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tiền') }} :</label>
                    <x-input type="number" min="0" name="amount" :value="$deposits->amount"
                        placeholder="{{ __('Số tiền') }}" :required="true" :readonly="$isReadonly" />
                </div>
            </div>
            <!-- note -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ghi chú') }} :</label>
                    <x-input name="note" :value="$deposits->note" placeholder="{{ __('Ghi chú') }}" :readonly="$isReadonly" />
                </div>
            </div>
        </div>
    </div>
</div>
