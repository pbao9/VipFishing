<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoWithdraw') }}</h2>
        </div>
        <div class="row card-body">
            <!-- user_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Người dùng') }}:</label>
                    <div class="mb-3">
                        <p class="mb-1">
                            <strong id="user-fullname">Tên người dùng</strong>
                            <span id="user-phone" class="text-muted">(Số điện thoại)</span>
                            <strong> - Số dư:</strong>
                            <strong id="user-balance" class="text-success">Số dư</strong>
                        </p>
                        <p class="mb-1">
                            <strong>Thông tin ngân hàng:</strong>
                            <strong id="user-bank-name" class="text-primary">Tên ngân hàng</strong>
                        </p>
                        <p class="mb-1">
                            <strong>Số tài khoản:</strong>
                            <strong id="user-bank-number" class="text-primary">Số tài khoản</strong>
                        </p>
                    </div>
                    <x-select class="select2-bs5-ajax" id="search-select-user" name="user_id"
                        :data-url="route('admin.search.select.user')" :required="true"></x-select>
                </div>
            </div>
            <!-- amount -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tiền') }} :</label>
                    <x-input type="number" min="0" name="amount" :value="old('amount')"
                        placeholder="{{ __('Số tiền') }}" :required="true" />
                </div>
            </div>
            <!-- other_bank -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngân hàng khác') }}:</label>
                    <x-select name="other_bank" id="other-bank-select">
                        <x-select-option value="0" title="Không" />
                        <x-select-option value="1" title="Có" />
                    </x-select>
                </div>
            </div>
            <!-- bank_id -->
            <div class="col-md-6 col-12 toggle-target d-none">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã ngân hàng') }}:</label>
                    <x-select class="select2-bs5-ajax" id="search-select-bank" name="bank_id"
                        :data-url="route('admin.search.select.bank')"></x-select>
                </div>
            </div>
            <!-- bank_number -->
            <div class="col-md-6 col-12 toggle-target d-none">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tài khoản') }} :</label>
                    <x-input name="bank_number" :value="old('bank_number')" placeholder="{{ __('Số tài khoản') }}" />
                </div>
            </div>
            <!-- note -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ghi chú') }} :</label>
                    <x-input name="note" :value="old('note')" placeholder="{{ __('Ghi chú') }}" />
                </div>
            </div>
        </div>
    </div>
</div>