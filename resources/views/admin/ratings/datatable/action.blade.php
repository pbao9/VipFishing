<div class="d-flex gap-2 align-items-center">
    <a href="{{ route('admin.ratings.edit', $rating->id) }}">
        <x-button type="button" class="btn-cyan btn-icon">
            <i class="ti ti-eye"></i>
        </x-button>
    </a>
    <x-button.modal-delete class="btn-icon" data-route="{{ route('admin.ratings.delete', $rating->id) }}">
        <i class="ti ti-trash"></i>
    </x-button.modal-delete>
</div>
