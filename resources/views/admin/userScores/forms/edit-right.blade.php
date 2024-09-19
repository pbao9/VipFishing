<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex align-items-center justify-content-between flex-wrap">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.userScores.delete', $userScores->id) }}"
                :title="__('Xóa')" />
            <x-link :href="route('admin.userScores.create')" class="btn btn-green my-1"><i
                    class="ti ti-plus"></i>{{ __('Thêm') }}</x-link>
        </div>
    </div>

</div>