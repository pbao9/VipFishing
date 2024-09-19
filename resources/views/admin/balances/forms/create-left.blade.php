<!-- <div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Balances') }}</h2>
        </div>
        <div class="row card-body">
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã người dùng') }}:</label>
                    <x-select name="user_id" :required="true">
                        @foreach ($users as $value)
                            <x-select-option :value="$value->id" :title="$value->fullname" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng tiền') }} :</label>
                    <x-input name="total_balance" min="0" :value="old('total_balance')" placeholder="{{ __('Tổng tiền') }}"
                        :required="true" />
                </div>
            </div>

        </div>
    </div>
</div> -->