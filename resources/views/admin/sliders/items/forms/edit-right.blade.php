<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.slider.item.delete', ['slider_id' => $sliderItem->slider_id ?? 0, 'id' => $sliderItem->id]) }}" :title="__('Xóa')" />
        </div>
    </div>
</div>