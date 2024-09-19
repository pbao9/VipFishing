<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete
                data-route="{{ route('admin.lakes.item.delete', ['lake_id' => $lakechilds->lake_id, 'id' => $lakechilds->id]) }}"
                :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select name="status" :required="true">
                @foreach ($status as $key => $value)
                    <x-select-option :option="$lakechilds->status" :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Mã cá') }}
        </div>
        <div class="card-body p-2">
            <x-select class="select2-bs5-ajax" name="fish_id" id="fishsSelect" :required="true">
                @if (isset($lakechilds->fish))
                    <x-select-option :option="$lakechilds->fish->id" :value="$lakechilds->fish->id" :title="$lakechilds->fish->name" />
                @endif
            </x-select>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Suất câu') }}
        </div>
        <div class="card-body p-2 wrap-list-checkbox">
            @foreach ($fishingSets as $fishingSet)
                @php
                    $checked = in_array($fishingSet->id, $lakechilds->fishingSets->pluck('id')->toArray());
                @endphp
                <x-input-checkbox :checked="[$checked ? $fishingSet->id : '']" name="fishingsets_id[]" :label="$fishingSet->title" :value="$fishingSet->id" />
            @endforeach
        </div>
    </div>
    <!-- open_day -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ngày mở cửa') }}
        </div>
        <div class="card-body p-2">
            @php
                $openDays = is_array($lakechilds->open_day)
                    ? $lakechilds->open_day
                    : json_decode($lakechilds->open_day, true);
                if (is_null($openDays)) {
                    $openDays = [];
                }
            @endphp
            @foreach ($daysOfWeek as $day)
                @php
                    $checked = in_array($day, $openDays);
                @endphp
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="open_day[]" value="{{ $day }}"
                        id="day-{{ $day }}" {{ $checked ? 'checked' : '' }}>
                    <label class="form-check-label" for="day-{{ $day }}">
                        {{ App\Enums\Lakechilds\DayOfWeek::getDescription($day) }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <!-- open_day -->
    <div class="card mb-3">
        <div class="card-header">
            <x-link :href="route('admin.lakes.item.rating.index', ['lakechild_id' => $lakechilds['id']])" class="text-decoration-none">
                <i class="ti ti-menu-2 px-2"></i>
                {{ __('Danh sách đánh giá') }}
            </x-link>
        </div>
        <div class="card-body p-2" class="d-flex align-items-center text-decoration-none mb-2">
            {{ __('Số lượng đánh giá') }}: <strong>{{ $totalRateValue }}</strong>
            <i class="ti ti-star text-yellow"></i>
        </div>
        <div class="card-body p-2" class="d-flex align-items-center text-decoration-none mb-2">
            {{ __('Đánh giá trung bình') }}: <strong>{{ $avgRate }}</strong>
            <i class="ti ti-star text-yellow"></i>
        </div>
    </div>
</div>
