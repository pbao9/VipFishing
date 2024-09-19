<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoTransactionHistory') }}</h2>
        </div>
        <div class="row card-body">
            <!-- user_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã người dùng') }}:</label>
                    <x-select class="select2-bs5-ajax" id="search-select-user" name="user_id"
                        :data-url="route('admin.search.select.user')" :required="true"></x-select>
                </div>
            </div>
            <!-- transaction_type -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hình thức') }} :</label>
                    <x-select name="transaction_type" :required="true">
                        @foreach ($transaction_type as $key => $value)
                            <x-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- amount -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tiền') }} :</label>
                    <x-input type="number" min="0" name="amount" :value="old('amount')" placeholder="{{ __('Số tiền') }}" />
                </div>
            </div>
        </div>
    </div>
</div>