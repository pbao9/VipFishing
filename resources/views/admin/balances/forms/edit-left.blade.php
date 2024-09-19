<!-- <div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin Balances') }}</h2>

        </div>
        <div class="row card-body">
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã người dùng') }}:</label>
                    <x-select name="user_id" readonly="true">
                        <x-select-option :option="$balances->user_id" :value="$user->id" :title="$user->fullname" />
                    </x-select>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng tiền') }} :</label>
                    <x-input name="total_balance" min="0" :value="$balances->total_balance"
                        placeholder="{{ __('Tổng tiền') }}" :required="true"/>
                </div>
            </div>

        </div>
    </div>
</div> -->