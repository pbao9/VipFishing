<div class="col-12 col-md-9">

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#tabs-profile" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                        role="tab">Thông tin</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-score" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab"
                        tabindex="-1">Điểm </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-commission" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                        role="tab" tabindex="-1">Được giới thiệu</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-historyTransaction" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                        role="tab" tabindex="-1">Lịch sử giao dịch</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="tabs-profile" role="tabpanel">
                    <div class="row">
                        <!-- Fullname -->
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Họ và tên') }}:</label>
                                <x-input name="fullname" :value="$user->fullname" :required="true"
                                    placeholder="{{ __('Họ và tên') }}" />
                            </div>
                        </div>
                        <!-- email -->
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Email') }}:</label>
                                <x-input-email name="email" :value="$user->email" :required="true" />
                            </div>
                        </div>
                        <!-- phone -->
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Số điện thoại') }}:</label>
                                <x-input-phone name="phone" :value="$user->phone" :required="true" />
                            </div>
                        </div>
                        <!-- address -->
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Địa chỉ') }}:</label>
                                <x-input name="address" :value="$user->address" :placeholder="__('Địa chỉ')" />
                            </div>
                        </div>
                        <!-- new password -->
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Mật khẩu') }}:</label>
                                <x-input-password name="password" />
                            </div>
                        </div>
                        <!-- new password confirmation-->
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Xác nhận mật khẩu') }}:</label>
                                <x-input-password name="password_confirmation"
                                    data-parsley-equalto="input[name='password']"
                                    data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
                            </div>
                        </div>
                        <!-- gender -->
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Giới tính') }}:</label>
                                <x-select name="gender" :required="true">
                                    <x-select-option value="" :title="__('Chọn Giới tính')" />
                                    @foreach ($gender as $key => $value)
                                        <x-select-option :option="$user->gender->value" :value="$key" :title="__($value)" />
                                    @endforeach
                                </x-select>
                            </div>
                        </div>
                        <!-- rank -->
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Xếp loại cần thủ') }} :</label>
                                <x-select class="select2-bs5-ajax" id="search-select-rank" name="rank_id"
                                    :data-url="route('admin.search.select.rank')">
                                    @if ($user->rank)
                                        <x-select-option :option="$user->rank_id" :value="$user->rank_id" :title="$user->rank->title" />
                                    @endif
                                </x-select>
                            </div>
                        </div>
                        <!-- bank_id -->
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Ngân hàng') }}:</label>
                                <x-select class="select2-bs5-ajax" id="search-select-bank" name="bank_id"
                                    :data-url="route('admin.search.select.bank')">
                                    @if ($user->bank)
                                        <x-select-option :option="$user->bank_id" :value="$user->bank_id" :title="$user->bank->name" />
                                    @endif
                                </x-select>
                            </div>
                        </div>
                        <!-- bank_number -->
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Số tài khoản') }} :</label>
                                <x-input name="bank_number" :value="$user->bank_number"
                                    placeholder="{{ __('Số tài khoản') }}" />
                            </div>
                        </div>
                        <!-- ref_status -->
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Trạng thái nhận hoa hồng') }} :</label>
                                <x-select name="ref_status">
                                    <x-select-option value="1" title="Có" />
                                    <x-select-option :option="$user->ref_status ?: '0'" value="0" title="Không" />
                                </x-select>
                            </div>
                        </div>
                        <!-- discount_user -->
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="control-label">{{ __('Ưu đãi cần thủ (%)') }} :</label>
                                <x-input type="number" :value="$user->discount_user" min="0" max="100"
                                    name="discount_user" :required="true" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-score" role="tabpanel">
                    <div class="row">
                        <div class="col-md-4 col-12 mb-3">
                            <div class="card">
                                <div class="card-header justify-content-between align-items-center">
                                    <div class="card-title">{{ __('Điểm CCV: ') }}</div>
                                    <span class="text-center">{{ $user->userscores['total_ccv'] ?? '0' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <div class="card">
                                <div class="card-header justify-content-between align-items-center">
                                    <div class="card-title">{{ __('Tổng trận đã câu: ') }}</div>
                                    <span class="text-center">{{ $user->userscores['total_round'] ?? '0' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <div class="card">
                                <div class="card-header justify-content-between align-items-center">
                                    <div class="card-title">{{ __('Tổng điểm HCV ') }}</div>
                                    <span class="text-center">{{ $user->userscores['total_hcv'] ?? '0' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <div class="card">
                                <div class="card-header justify-content-between align-items-center">
                                    <div class="card-title">{{ __('Tổng giải thưởng đã nhận: ') }}</div>
                                    <span class="text-center">{{ $user->userscores['total_awards'] ?? '0' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="card">
                                <div class="card-header justify-content-between align-items-center">
                                    <div class="card-title">{{ __('Tổng hồ đã câu: ') }}</div>
                                    <span class="text-center">{{ $user->userscores['total_lake'] ?? '0' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <div class="card">
                                <div class="card-header justify-content-between align-items-center">
                                    <div class="card-title">{{ __('Tổng tỉnh đã câu: ') }}</div>
                                    <span class="text-center">{{ $user->userscores['total_province'] ?? '0' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <div class="card">
                                <div class="card-header justify-content-between align-items-center">
                                    <div class="card-title">{{ __('Tổng lần đánh giá: ') }}</div>
                                    <span class="text-center">{{ $user->userscores['total_rating'] ?? '0' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-commission" role="tabpanel">
                    <div class="card-body">
                        @include('admin.users.include.referr')
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-historyTransaction" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs justify-content-center" data-bs-toggle="tabs"
                                role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs_booking" class="nav-link active" data-bs-toggle="tab"
                                        aria-selected="true" role="tab">
                                        {{ __('Thanh toán') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs_deposit_withdraw" class="nav-link" data-bs-toggle="tab"
                                        aria-selected="false" tabindex="-1" role="tab">
                                        {{ __('Nạp/Rút') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs_booking" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th>Loại giao dịch</th>
                                                    <th>Số tiền</th>
                                                    <th>Số dư</th>
                                                    <th>Ngày thực hiện</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bookingHistoryTransaction as $item)
                                                    <tr>
                                                        <td>
                                                            {{ App\Enums\TransactionHistory\TransactionHistoryType::getDescription($item->transaction_type) }}
                                                        </td>
                                                        <td class="text-secondary">
                                                            -{{ number_format($item->amount, 0, ',', '.') }} VNĐ
                                                        </td>
                                                        <td class="text-secondary">
                                                            {{ number_format($item->balance_after, 0, ',', '.') }} VNĐ
                                                        </td>
                                                        <td class="text-secondary">
                                                            {{ $item->created_at->format('d/m/Y H:i') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs_deposit_withdraw" role="tabpanel">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Loại giao dịch</th>
                                                <th>Số tiền</th>
                                                <th>Số dư</th>
                                                <th>Ngày thực hiện</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($depositWithdrawHistoryTransaction as $item)
                                                <tr>
                                                    <td>
                                                        {{ App\Enums\TransactionHistory\TransactionHistoryType::getDescription($item->transaction_type) }}
                                                    </td>
                                                    <td class="text-secondary">
                                                        {{ number_format($item->amount, 0, ',', '.') }} VNĐ
                                                    </td>
                                                    <td class="text-secondary">
                                                        {{ number_format($item->balance_after, 0, ',', '.') }} VNĐ
                                                    </td>
                                                    <td class="text-secondary">
                                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
