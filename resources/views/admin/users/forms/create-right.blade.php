<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('Thêm')" />
        </div>
    </div>
    <!-- avatar -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh đại diện') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="avatar" showImage="avatar" />
        </div>
    </div>
    <!-- rank -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Rank') }}
        </div>
        <div class="card-body p-2">
            <x-select class="select2-bs5-ajax" id="search-select-rank" name="rank_id"
                :data-url="route('admin.search.select.rank')"></x-select>
        </div>
    </div>
    <!-- status -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select class="form-select" name="status" :required="true">
                <x-select-option value="1" :title="__('Hoạt động')" />
                <x-select-option value="0" :title="__('Tạm ngưng')" />
            </x-select>
        </div>
    </div>
</div>