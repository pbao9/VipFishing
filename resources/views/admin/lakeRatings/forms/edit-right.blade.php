<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.modal-delete data-route="{{ route('admin.ratings.delete', $ratings->id) }}" :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Hình ảnh') }}
        </div>
        <div class="card-body p-2">
            <x-input-gallery-ckfinder name="gallery" type="multiple" :value="$ratings->picture" />
        </div>
    </div>
</div>


