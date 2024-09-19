<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoUser') }}</h2>
        </div>
        <div class="row card-body">
            <!-- Fullname -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Họ và tên') }}:</label>
                    <x-input name="fullname" :value="old('fullname')" :required="true" placeholder="{{ __('Họ và tên') }}" />
                </div>
            </div>
            <!-- email -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Email') }}:</label>
                    <x-input-email name="email" :value="old('email')" :required="true" />
                </div>
            </div>
            <!-- phone -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số điện thoại') }}:</label>
                    <x-input-phone name="phone" :value="old('phone')" :required="true" />
                </div>
            </div>
            <!-- address -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Địa chỉ') }}:</label>
                    <x-input name="address" :value="old('address')" :placeholder="__('Địa chỉ')" />
                </div>
            </div>
            <!-- new password -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mật khẩu') }}:</label>
                    <x-input-password name="password" :required="true" />
                </div>
            </div>
            <!-- new password confirmation-->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Xác nhận mật khẩu') }}:</label>
                    <x-input-password name="password_confirmation" :required="true"
                        data-parsley-equalto="input[name='password']"
                        data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
                </div>
            </div>
            <!-- gender -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giới tính') }}:</label>
                    <x-select name="gender" :required="true">
                        <x-select-option value="" :title="__('Chọn Giới tính')" />
                        @foreach ($gender as $key => $value)
                            <x-select-option :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- bank_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã ngân hàng') }}:</label>
                    <x-select class="select2-bs5-ajax" id="search-select-bank" name="bank_id"
                        :data-url="route('admin.search.select.bank')"></x-select>
                </div>
            </div>
            <!-- bank_number -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tài khoản') }} :</label>
                    <x-input name="bank_number" :value="old('bank_number')" placeholder="{{ __('Số tài khoản') }}" />
                </div>
            </div>
            <!-- ref_status -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ref status') }} :</label>
                    <x-select name="ref_status">
                        <x-select-option value="0" title="Không" />
                        <x-select-option value="1" title="Có" />
                    </x-select>
                </div>
            </div>
            <!-- discount_user -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ưu đãi cần thủ (%)') }} :</label>
                    <x-input type="number" min="0" max="100" name="discount_user" :required="true" />
                </div>
            </div>
        </div>
    </div>
</div>
