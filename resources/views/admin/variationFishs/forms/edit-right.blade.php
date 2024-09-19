<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex align-items-center justify-content-between flex-wrap">
            <x-button.submit :title="__('Cập nhật')" />
            {{-- <x-button.modal-delete data-route="{{ route('admin.fishs.item.delete', $variationFishs->id) }}" :title="__('Xóa')" /> --}}
            <x-button.modal-delete data-route="{{ route('admin.fishs.item.delete', ['fish_id' => $variationFishs->fish_id ?? 0, 'id' => $variationFishs->id]) }}" :title="__('Xóa')" />
            {{-- <x-button.modal-delete data-route="{{ route('admin.slider.item.delete', ['slider_id' => $sliderItem->slider_id ?? 0, 'id' => $sliderItem->id]) }}" :title="__('Xóa')" /> --}}
            <x-link :href="route('admin.fishs.item.create', $variationFishs->fish_id)" class="btn btn-green my-1"><i
                    class="ti ti-plus"></i>{{ __('Thêm') }}</x-link>
        </div>
    </div>

</div>