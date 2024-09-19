<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex align-items-center justify-content-between flex-wrap">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.user.delete', $user->id) }}" :title="__('Xóa')" />
            <x-link :href="route('admin.user.create')" class="btn btn-green my-1"><i class="ti ti-plus"></i>{{ __('Thêm') }}</x-link>
        </div>
    </div>

    <!-- avatar -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title">
                <span>{{ __('Mã giới thiệu') }}</span>
            </div>
        </div>
        <div class="card-body">
            <span class="text-warning fw-bold">{{ $user->code }} </span>
        </div>
    </div>

  



    <!-- avatar -->
    <div class="card mb-3">
        <div class="card-header justify-content-between">
            <span>{{ __('Số dư tài khoản') }}</span>
            <span
                class="text-success fw-bold">{{ number_format($user->balance['total_balance'], 0, ',', '.') }}VNĐ</span>
        </div>
    </div>
    <!-- status -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select class="form-select" name="status" :required="true">
                <x-select-option value="1" :title="__('Hoạt động')" />
                <x-select-option :option="$user->status ?: '0'" value="0" :title="__('Tạm ngưng')" />
            </x-select>
        </div>
    </div>
    <!-- avatar -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh đại diện') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="avatar" showImage="avatar" :value="$user->avatar" />
        </div>
    </div>

</div>
