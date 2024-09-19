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
            {{ __('Ảnh đánh giá') }}
        </div>
        <div class="card-body p-2">
            <x-input-gallery-ckfinder name="picture" type="multiple" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select class="form-select" name="status" :required="true">
                <x-select-option value="1" :title="__('Có')" />
                <x-select-option value="0" :title="__('Không')" />
            </x-select>
        </div>
    </div>

</div>
