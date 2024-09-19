<div class="col-12 col-md-3">
    @php
        $isReadonly = false;
        if ($withdraws->status == 1) {
            $isReadonly = true;
        }
    @endphp
    @if (!$isReadonly)
        <div class="card mb-3">
            <div class="card-header">
                {{ __('Cập nhật') }}
            </div>
            <div class="card-body p-2 d-flex align-items-center justify-content-between flex-wrap">
                <x-button.submit :title="__('Cập nhật')" />
                <x-button.modal-delete data-route="{{ route('admin.withdraws.delete', $withdraws->id) }}"
                    :title="__('Xóa')" />
                <x-link :href="route('admin.withdraws.create')" class="btn btn-green my-1"><i
                        class="ti ti-plus"></i>{{ __('Thêm') }}</x-link>
            </div>
        </div>
    @endif
    <!-- status -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-select name="status" :required="true">
                @if ($isReadonly)
                    <x-select-option :option="$withdraws->status" :value="$withdraws->status" :title="__('Đã hoàn thành')" />
                @else
                    @switch($withdraws->status)
                        @case(\App\Enums\WithdrawsStatus::Peding)
                            @foreach ($status as $key => $value)
                                <x-select-option :option="$withdraws->status" :value="$key" :title="$value" />
                            @endforeach
                        @break

                        @case(\App\Enums\WithdrawsStatus::Declined)
                            <span class="badge bg-danger">Đã Hủy</span>
                        @break

                        @default
                    @endswitch
                @endif
            </x-select>
        </div>
    </div>

    <!-- license -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh chứng từ') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder :value="$withdraws->license" name="license" showImage="license" :readonly="$isReadonly" />
        </div>
    </div>

    <!-- admin_license -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh chứng từ của Quản lý') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder :value="$withdraws->admin_license" name="admin_license" showImage="admin_license"
                :readonly="$isReadonly" />
        </div>
    </div>
</div>
