<x-button.modal-delete class="btn-icon" data-route="{{ route('admin.userScores.delete', $id) }}">
    <i class="ti ti-trash"></i>
</x-button.modal-delete> 
<a href="{{ route('admin.userScores.edit', $id) }}"><x-button type="button" class="btn-info btn-icon">
    <i class="ti ti-pencil"></i>
</x-button></a>