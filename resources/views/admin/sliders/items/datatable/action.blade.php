
<x-button.modal-delete class="btn-icon" data-route="{{ route('admin.slider.item.delete', [
    'slider_id' => $slider_id,
    'id' => $id
]) }}">
    <i class="ti ti-trash"></i>
</x-button.modal-delete>