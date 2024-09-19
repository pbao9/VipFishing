<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.module.delete', $module->id) }}" :title="__('Xóa')" />
        </div>
    </div>
	<div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select name="status" :required="true">
                @foreach ($status as $key => $value)
                    <x-select-option :option="(int)$module->status" :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>
</div>