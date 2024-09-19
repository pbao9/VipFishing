<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoWithdraw') }}</h2>
            @php
                $isReadonly = false;
                if ($withdraws->status == 1) {
                    echo "<span class='bg-green-lt'>Đã hoàn tất giao dịch rút</span>";
                    $isReadonly = true;
                }
            @endphp
        </div>
        <div class="row card-body">
            <!-- user_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Người dùng') }}:</label>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <p class="mb-1">
                                <strong>{{ $withdraws->user->fullname }}</strong>
                                <span class="text-muted">({{ $withdraws->user->phone }})</span>
                                <strong> - Số dư:</strong>
                                <strong
                                    class="text-success">{{ number_format($withdraws->user->balance->total_balance, 0, ',', '.') }}
                                    VNĐ</strong>
                            </p>
                            <p class="mb-1">
                                <strong>Thông tin ngân hàng:</strong>
                                <strong class="text-primary">{{ $withdraws->user->bank->name }}</strong>
                            </p>
                            <p class="mb-1">
                                <strong>Số tài khoản:</strong>
                                <strong class="text-primary">{{ $withdraws->user->bank_number }}</strong>
                            </p>
                        </div>
                        @if ($withdraws->other_bank)
                            <div class="col-md-6 col-12">
                                <p class="mb-1">
                                    <strong class="text-danger">Yêu cầu rút tiền ở ngân hàng khác:</strong>
                                </p>
                                <p class="mb-1">
                                    <strong>Thông tin ngân hàng:</strong>
                                    <strong class="text-primary">{{ $withdraws->bank->name }}</strong>
                                </p>
                                <p class="mb-1">
                                    <strong>Số tài khoản:</strong>
                                    <strong class="text-primary">{{ $withdraws->bank_number }}</strong>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- amount -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tiền') }} :</label>
                    <x-input type="number" min="0" name="amount" :value="$withdraws->amount"
                        placeholder="{{ __('Số tiền') }}" :required="true" :readonly="$isReadonly" />
                </div>
            </div>
            <!-- other_bank -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngân hàng khác') }}:</label>
                    <x-select name="other_bank" id="other-bank-select">
                        @if ($isReadonly)
                            <x-select-option :option="$withdraws->other_bank" :value="$withdraws->other_bank"
                                :title="$withdraws->other_bank ? 'Có' : 'Không'" />
                        @else
                            <x-select-option value="1" title="Có" />
                            <x-select-option :option="$withdraws->other_bank ?: '0'" value="0" title="Không" />
                        @endif
                    </x-select>
                </div>
            </div>
            <!-- bank_id -->
            <div class="col-md-6 col-12 toggle-target d-none">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã ngân hàng') }}:</label>
                    @if ($isReadonly)
                        <x-select name="bank_id">
                            @if ($withdraws->bank)
                                <x-select-option :option="$withdraws->bank_id" :value="$withdraws->bank_id"
                                    :title="$withdraws->bank->name" />
                            @endif
                        </x-select>
                    @else
                        <x-select class="select2-bs5-ajax" id="search-select-bank" name="bank_id"
                            :data-url="route('admin.search.select.bank')">
                            @if ($withdraws->bank)
                                <x-select-option :option="$withdraws->bank_id" :value="$withdraws->bank_id"
                                    :title="$withdraws->bank->name" />
                            @endif
                        </x-select>
                    @endif
                </div>
            </div>
            <!-- bank_number -->
            <div class="col-md-6 col-12 toggle-target d-none">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tài khoản') }} :</label>
                    <x-input name="bank_number" :value="$withdraws->bank_number" placeholder="{{ __('Số tài khoản') }}"
                        :readonly="$isReadonly" />
                </div>
            </div>
            <!-- note -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ghi chú') }} :</label>
                    <x-input name="note" :value="$withdraws->note" placeholder="{{ __('Ghi chú') }}"
                        :readonly="$isReadonly" />
                </div>
            </div>
        </div>
    </div>
</div>