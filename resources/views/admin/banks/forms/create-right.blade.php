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
            {{ __('Logo') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="logo" showImage="logo" />
        </div>
    </div>

</div>
