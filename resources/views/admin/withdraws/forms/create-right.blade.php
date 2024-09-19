<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('Thêm')" />
        </div>
    </div>
    <!-- license -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh chứng từ') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="license" showImage="license" />
        </div>
    </div>
</div>