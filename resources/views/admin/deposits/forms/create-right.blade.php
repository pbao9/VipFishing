<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('Thêm')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Loại') }}
        </div>
        <div class="card-body p-2">
            <x-select name="type" :required="true">
                <x-select-option value="" :title="__('Loại nạp tiền')" />
                @foreach ($type as $key => $value)
                    <x-select-option :value="$key" :title="__($value)" />
                @endforeach
            </x-select>
        </div>
    </div>

    <!-- license -->
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh chứng từ') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="license" showImage="licenscáe" />
        </div>
    </div>
</div>
