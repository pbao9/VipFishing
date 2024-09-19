<div class="col-12 col-md-3">
    @php
        $isReadonly = false;
        if (
            $bookings->status == \App\Enums\Bookings\BookingsStatus::Completed ||
            $bookings->status == \App\Enums\Bookings\BookingsStatus::Cancelled
        ) {
            $isReadonly = true;
        }
    @endphp
    @if (!$isReadonly)
        <div class="card mb-3">
            <div class="card-header">
                {{ __('Cập nhật') }}
            </div>
            <div class="card-body p-2 d-flex align-items-center justify-content-between flex-wrap">
                <x-button.submit :title="__('Cập nhật')" />
                <x-button.modal-delete data-route="{{ route('admin.bookings.delete', $bookings->id) }}"
                    :title="__('Xóa')" />
                <x-link :href="route('admin.bookings.create')" class="btn btn-green my-1"><i
                        class="ti ti-plus"></i>{{ __('Thêm') }}</x-link>
            </div>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title">{{ __('Mã đơn đặt câu') }}</div>
        </div>
        <div class="card-body p-2">
            <span class="badge bg-azure-lt">
                {{ $bookings->booking_code }}
            </span>
        </div>
    </div>
    @if (!$deposits && $bookings->status == \App\Enums\Bookings\BookingsStatus::Completed)
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">{{ __('Thu cá') }}</div>
            </div>
            <div class="card-body p-2">
                <a href="#" class="btn bg-azure-lt w-100" data-bs-toggle="modal" data-bs-target="#modal-simple">
                    {{ __('Thanh toán tiền thu cá ') }}
                </a>
            </div>
        </div>
    @elseif ($deposits)
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">
                    <span class="badge bg-success"> {{ __('Đã thanh toán tiền thu cá!') }} </span>
                </div>
            </div>
        </div>
    @else
    @endif

    <!-- Status -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title">
                {{ __('Trạng thái đơn câu') }}
            </div>
        </div>
        <div class="card-body">
            @if ($isReadonly)
                <span class="badge bg-success-lt">
                    {{ \App\Enums\Bookings\BookingsStatus::getDescription($bookings->status) }}
                </span>
            @else
                @switch($bookings->status)
                    @case(App\Enums\Bookings\BookingsStatus::Unpaid)
                        <x-select name="status" :required="true">
                            @if (
                                $bookings->status == \App\Enums\Bookings\BookingsStatus::Cancelled ||
                                    $bookings->status == \App\Enums\Bookings\BookingsStatus::Completed)
                                <x-select-option :option="$bookings->status" :value="$bookings->status" :title="\App\Enums\Bookings\BookingsStatus::getDescription($bookings->status)" />
                            @else
                                @foreach ($status as $key => $value)
                                    <x-select-option :option="$bookings->status" :value="$key" :title="$value" />
                                @endforeach
                            @endif
                        </x-select>
                    @break

                    @case(App\Enums\Bookings\BookingsStatus::Paid)
                        <x-button.submit :title="__('Đã đến hồ')" class="bg-teal w-100" />
                        <input type="hidden" value="{{ \App\Enums\Bookings\BookingsStatus::Fishing }}" name="status">
                    @break

                    @default
                        <x-button.submit :title="__('Đã hoàn thành đơn')" class="bg-success w-100" />
                        <input type="hidden" value="{{ \App\Enums\Bookings\BookingsStatus::Completed }}" name="status">
                @endswitch
            @endif
        </div>
    </div>
</div>
