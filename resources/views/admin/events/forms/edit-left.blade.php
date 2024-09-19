@php
    $statusMap = [
        \App\Enums\Events\EventStatus::Ongoing => ['class' => 'bg-blue-lt', 'message' => 'Sự kiện đang diễn ra'],
        \App\Enums\Events\EventStatus::Paused => ['class' => 'bg-yellow-lt', 'message' => 'Sự kiện đã tạm ngưng'],
        \App\Enums\Events\EventStatus::Cancelled => ['class' => 'bg-pink-lt', 'message' => 'Sự kiện đã hủy'],
        \App\Enums\Events\EventStatus::Finished => ['class' => 'bg-green-lt', 'message' => 'Sự kiện đã kết thúc'],
    ];

    $isReadonly = false;
    $disableDates = false;

    if ($events->status == \App\Enums\Events\EventStatus::Cancelled || $events->status == \App\Enums\Events\EventStatus::Finished) {
        $isReadonly = true;
    } elseif ($events->status == \App\Enums\Events\EventStatus::Paused) {
        $disableDates = true;
    }
@endphp

<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('infoEvent') }}</h2>
            @php
                if (isset($statusMap[$events->status])) {
                    $statusInfo = $statusMap[$events->status];
                    echo "<span class='badge {$statusInfo['class']}'>{$statusInfo['message']}</span>";
                }
            @endphp
        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tiêu đề') }} :</label>
                    <x-input name="title" :value="$events->title" placeholder="{{ __('Tiêu đề') }}"
                        :readonly="$isReadonly" />
                </div>
            </div>
            <!-- reward -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Phần thưởng') }} :</label>
                    <x-textarea class="ckeditor visually-hidden" name="reward" required="true"
                        :readonly="$isReadonly">{{ $events->reward }}</x-textarea>
                </div>
            </div>
            <!-- reward_value -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá trị phần thưởng') }} :</label>
                    <x-input type="number" name="reward_value" :value="$events->reward_value"
                        placeholder="{{ __('Giá trị phần thưởng') }}" required="true" :readonly="$isReadonly" />
                </div>
            </div>
            <!-- reward_quantity -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số lượng phần thưởng') }} :</label>
                    <x-input type="number" name="reward_quantity" :value="$events->reward_quantity"
                        placeholder="{{ __('Số lượng phần thưởng') }}" required="true" :readonly="$isReadonly" />
                </div>
            </div>
            <!-- start_date -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian bắt đầu') }} :</label>
                    <x-input type="date" name="start_date"
                        value="{{ \Carbon\Carbon::parse($events->start_date)->format('Y-m-d') }}"
                        placeholder="{{ __('Thời gian bắt đầu') }}" required="true" :readonly="$isReadonly || $disableDates" />
                </div>
            </div>
            <!-- end_date -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Thời gian kết thúc') }} :</label>
                    <x-input type="date" name="end_date"
                        value="{{ \Carbon\Carbon::parse($events->end_date)->format('Y-m-d') }}"
                        placeholder="{{ __('Thời gian kết thúc') }}" required="true" :readonly="$isReadonly || $disableDates" />
                </div>
            </div>
        </div>
    </div>
</div>