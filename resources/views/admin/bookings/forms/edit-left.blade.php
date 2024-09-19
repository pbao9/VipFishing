<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoBooking') }}</h2>
            @php
                $statusMap = [
                    \App\Enums\Bookings\BookingsStatus::Cancelled => ['class' => 'bg-red-lt', 'message' => 'Đơn đặt câu đã bị hủy'],
                    \App\Enums\Bookings\BookingsStatus::Paid => ['class' => 'bg-blue-lt', 'message' => 'Đơn đặt câu đã được thanh toán', 'note' => 'Có thể thay đổi trạng thái'],
                    \App\Enums\Bookings\BookingsStatus::Fishing => ['class' => 'bg-yellow-lt', 'message' => 'Đang câu', 'note' => 'Có thể thay đổi trạng thái'],
                    \App\Enums\Bookings\BookingsStatus::Completed => ['class' => 'bg-green-lt', 'message' => 'Đã hoàn thành câu'],
                ];

                $isReadonly = false;
                $statusInfo = $statusMap[$bookings->status] ?? null;
            @endphp

            @if ($statusInfo)
                <span class='badge {{ $statusInfo['class'] }}'>{{ $statusInfo['message'] }}</span>
                @isset($statusInfo['note'])
                    <quote>{{ $statusInfo['note'] }}</quote>
                @endisset
                @php    $isReadonly = true; @endphp
            @endif
        </div>
        <div class="row card-body">
            <!-- fishing_date -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày câu') }} :</label>
                    @if ($isReadonly)
                        <strong>{{ \Carbon\Carbon::parse($bookings->fishing_date)->format('Y-m-d') }}</strong>
                    @else
                        <x-input type="date" name="fishing_date"
                            value="{{ \Carbon\Carbon::parse($bookings->fishing_date)->format('Y-m-d') }}"
                            placeholder="{{ __('Ngày câu') }}" :required="true" :readonly="$isReadonly" />
                    @endif
                </div>
            </div>
            <!-- user_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Người dùng') }}:</label>
                    <div class="mb-3">
                        <p class="mb-1">
                            <strong>{{ $bookings->user->fullname }}</strong>
                            <span class="text-muted">({{ $bookings->user->phone }})</span>
                            <strong> - Số dư:</strong>
                            <strong class="text-success">{{ $bookings->user->balance->total_balance }}</strong>
                        </p>
                        <p class="mb-1">
                            <strong>Thông tin ngân hàng:</strong>
                            <strong class="text-primary">{{ $bookings->user->bank->name }}</strong>
                        </p>
                        <p class="mb-1">
                            <strong>Số tài khoản:</strong>
                            <strong class="text-primary">{{ $bookings->user->bank_number }}</strong>
                        </p>
                    </div>
                    {{--<x-select name="user_id" :required="true">
                        <x-select-option :option="$bookings->user_id" :value="$bookings->user_id" :title="$titleUser" />
                    </x-select>--}}
                </div>
            </div>
            <!-- lakeChild_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">
                        <strong>{{ __('Hồ lẻ') }}:</strong> <span id="lakechild-name"
                            class="text-success">{{ $bookings->lakechild->name }}</span>
                        - Hồ: <span id="lake-name" class="text-primary">{{ $bookings->lakechild->lake->name }}</span>
                    </label>
                    @php
                        $titleLakechild = "{$bookings->lakechild->name} - {$bookings->lakechild->lake->name} ({$bookings->lakechild->lake->phone})"
                    @endphp
                    @if ($isReadonly)
                        <x-select name="lakeChild_id" :required="true">
                            <x-select-option :option="$bookings->lakeChild_id" :value="$bookings->lakeChild_id"
                                :title="$titleLakechild" />
                        </x-select>
                    @else
                        <x-select class="select2-bs5-ajax" id="search-select-lakechild" name="lakeChild_id"
                            :data-url="route('admin.search.select.lakechild')" :required="true">
                            <x-select-option :option="$bookings->lakeChild_id" :value="$bookings->lakeChild_id"
                                :title="$titleLakechild" />
                        </x-select>
                    @endif
                </div>
            </div>
            <!-- fishingset_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">
                        <strong>{{ __('Suất câu') }}:</strong>
                        - Bắt đầu: <span id="fishingset-time-start" class="text-primary">
                            {{ \Carbon\Carbon::parse($bookings->fishingset->time_start)->format('H:i') }}
                        </span>
                        - Kết thúc: <span id="fishingset-time-end" class="text-primary">
                            {{ \Carbon\Carbon::parse($bookings->fishingset->time_end)->format('H:i') }}
                        </span>
                        - Độ dài: <span id="fishingset-duration"
                            class="text-secondary">{{ $bookings->fishingset->duration }}h</span>
                    </label>
                    @if ($isReadonly)
                        <x-select name=" fishingset_id" :required="true">
                            <x-select-option :option="$bookings->fishingset_id" :value="$bookings->fishingset_id"
                                :title="$bookings->fishingset->title" />
                        </x-select>
                    @else
                        <x-select id="search-select-fishingset" name="fishingset_id" :required="true">
                            @foreach ($bookings->lakechild->fishingSets as $fishingset)
                                <x-select-option :option="$bookings->fishingset_id" :value="$fishingset->id"
                                    :title="$fishingset->title" data-data-fishingset="{{ json_encode($fishingset) }}" />
                            @endforeach
                        </x-select>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>