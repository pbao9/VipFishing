<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('Thêm')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select class="form-select" name="status" :required="true">
                @foreach ($lakechildStatus as $key => $value)
                    <x-select-option :value="$key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Cá thả hồ') }}
        </div>
        <div class="card-body p-2">
            <x-select class="select2-bs5-ajax" name="fish_id" id="fishsSelect" :data-url="route('admin.search.select.fishs')"></x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Suất câu') }}
        </div>
        <div class="card-body p-2 wrap-list-checkbox">
            @foreach ($fishingSets as $fishingSet)
                <x-input-checkbox name="fishingsets_id[]" :label="$fishingSet->title" :value="$fishingSet->id" />
            @endforeach
        </div>
    </div>
    <input type="hidden" name="lake_id" value="{{ $lake->id }}">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ngày mở cửa') }}
        </div>
        <div class="card-body p-2">
            @foreach ($daysOfWeek as $day)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="open_day[]" value="{{ $day }}"
                        id="day-{{ $day }}">
                    <label class="form-check-label" for="day-{{ $day }}">
                        {{ App\Enums\Lakechilds\DayOfWeek::getDescription($day) }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>
