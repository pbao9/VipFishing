@php
    // Xác định các trạng thái sự kiện
    $statusMap = [
        \App\Enums\Events\EventStatus::Ongoing => 'Sự kiện đang diễn ra',
        \App\Enums\Events\EventStatus::Paused => 'Sự kiện đã tạm ngưng',
        \App\Enums\Events\EventStatus::Cancelled => 'Sự kiện đã hủy',
        \App\Enums\Events\EventStatus::Finished => 'Sự kiện đã kết thúc',
    ];

    // Xác định trạng thái readonly và tùy chọn trạng thái
    $isReadonly = false;
    $statusReadonly = false;

    if ($events->status == \App\Enums\Events\EventStatus::Ongoing) {
        $isReadonly = true;
    } elseif ($events->status == \App\Enums\Events\EventStatus::Paused) {
        $isReadonly = true;
    } elseif ($events->status == \App\Enums\Events\EventStatus::Cancelled || $events->status == \App\Enums\Events\EventStatus::Finished) {
        $isReadonly = true;
        $statusReadonly = true;
    }
@endphp

<div class="col-12 col-md-3">
    @if (!$isReadonly)
        <div class="card mb-3">
            <div class="card-header">
                {{ __('Đăng') }}
            </div>
            <div class="card-body p-2 d-flex align-items-center justify-content-between flex-wrap">
                <x-button.submit :title="__('Cập nhật')" />
                <x-button.modal-delete data-route="{{ route('admin.events.delete', $events->id) }}" :title="__('Xóa')" />
                <x-link :href="route('admin.events.create')" class="btn btn-green my-1"><i
                        class="ti ti-plus"></i>{{ __('Thêm') }}</x-link>
            </div>
        </div>
    @endif
    <!-- status -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select class="form-select" name="status" :required="true">
                @if ($isReadonly && $statusReadonly)
                    <x-select-option :option="$events->status" :value="$events->status"
                        :title="\App\Enums\Events\EventStatus::getDescription($events->status)" />
                @else
                    @foreach ($status as $key => $value)
                        <x-select-option :option="$events->status" :value="$key" :title="$value" />
                    @endforeach
                @endif
            </x-select>
        </div>
    </div>
    <!-- user_id -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Người dùng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-select name="user_id" :required="true">
                @php
                    $titleUser = $events->user->fullname . ' - ' . $events->user->phone;
                @endphp
                <x-select-option :option="$events->user_id" :value="$events->user_id" :title="$titleUser" />
            </x-select>
        </div>
    </div>
    <!-- lakechild_id -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Hổ lẻ') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            @if ($isReadonly)
                <x-select name="lakechild_id" :required="true">
                    <x-select-option :option="$events->lakechild_id" :value="$events->lakechild_id"
                        :title="$events->lakechild->name" />
                </x-select>
            @else
                <x-select class="select2-bs5-ajax" id="search-select-lakechild" name="lakechild_id"
                    :data-url="route('admin.search.select.lakechild')" :required="true">
                    <x-select-option :option="$events->lakechild_id" :value="$events->lakechild_id"
                        :title="$events->lakechild->name" />
                </x-select>
            @endif
        </div>
    </div>
    <!-- picture -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Hình ảnh sự kiện') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-input-image-ckfinder name="picture" showImage="image" :value="$events->picture"
                :readonly="$isReadonly" />
        </div>
    </div>
    <!-- events_condition -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Điều kiện') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-select name="events_condition" id="events-condition-select">
                @if ($isReadonly)
                    <x-select-option :option="$events->events_condition" :value="$events->events_condition"
                        :title="$events->events_condition ? 'Có' : 'Không'" />
                @else
                    <x-select-option value="1" title="Có" />
                    <x-select-option :option="$events->events_condition ?: '0'" value="0" title="Không" />
                @endif
            </x-select>
        </div>
    </div>
    <!-- ccv_point -->
    <div class="card mb-3 toggle-target d-none">
        <div class="card-header">
            {{ __('Điểm CCV') }}
        </div>
        <div class="card-body p-2">
            <x-input type="number" name="ccv_point" :value="$events->ccv_point" placeholder="{{ __('Điểm CCV') }}"
                :readonly="$isReadonly" />
        </div>
    </div>
    <!-- rank_id -->
    <div class="card mb-3 toggle-target d-none">
        <div class="card-header">
            {{ __('Xếp loại') }}
        </div>
        <div class="card-body p-2">
            @if (!$isReadonly)
                <x-select class="select2-bs5-ajax" id="search-select-rank" name="rank_id"
                    :data-url="route('admin.search.select.rank')">
                    @if ($events->rank)
                        <x-select-option :option="$events->rank_id" :value="$events->rank_id" :title="$events->rank->title" />
                    @endif
                </x-select>
            @else
                @if ($events->rank)
                    <x-select name="rank_id" :required="true">
                        <x-select-option :option="$events->rank_id" :value="$events->rank_id" :title="$events->rank->title" />
                    </x-select>
                @endif
            @endif
        </div>
    </div>
</div>