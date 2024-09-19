<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('Thêm')" />
        </div>
    </div>
    <!-- status -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select class="form-select" name="status" :required="true">
                @foreach ($status as $key => $value)
                    <x-select-option :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>
    <!-- user_id -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Người dùng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-select class="select2-bs5-ajax" id="search-select-user" name="user_id" :data-url="route('admin.search.select.user')"
                :required="true"></x-select>
        </div>
    </div>
    <!-- lakechild_id -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Hổ lẻ') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-select class="select2-bs5-ajax" id="search-select-lakechild" name="lakechild_id" :data-url="route('admin.search.select.lakechild')"
                :required="true"></x-select>
        </div>
    </div>
    <!-- picture -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Hình ảnh sự kiện') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-input-image-ckfinder name="picture" showImage="picture" />
        </div>
    </div>
    <!-- events_condition -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Điều kiện') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-select name="events_condition" id="events-condition-select">
                @foreach ($ec as $key => $value)
                    <x-select-option :value="$key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>
    </div>

    <!-- ccv_point -->
    <div class="card mb-3 toggle-target d-none">
        <div class="card-header">
            {{ __('Điểm CCV') }}
        </div>
        <div class="card-body p-2">
            <x-input type="number" name="ccv_point" :value="old('ccv_point')" placeholder="{{ __('Điểm CCV') }}" />
        </div>
    </div>
    <!-- rank_id -->
    <div class="card mb-3 toggle-target d-none">
        <div class="card-header">
            {{ __('Xếp loại') }}
        </div>
        <div class="card-body p-2">
            <x-select class="select2-bs5-ajax" id="search-select-rank" name="rank_id" :data-url="route('admin.search.select.rank')"></x-select>
        </div>
    </div>
</div>
