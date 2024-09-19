<div class="d-flex flex-nowrap gap-2">

    <x-link :href="route('admin.lakes.item.edit', $id)" class="btn btn-info btn-icon"><i class="ti ti-pencil"></i></x-link>
    <x-button.modal-delete class="btn-icon"
        data-route="{{ route('admin.lakes.item.delete', [
            'lake_id' => $lake_id,
            'id' => $id,
        ]) }}">
        <i class="ti ti-trash"></i>
    </x-button.modal-delete>

</div>
