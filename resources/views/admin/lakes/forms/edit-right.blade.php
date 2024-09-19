<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex align-items-center justify-content-between flex-wrap">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.lakes.delete', $lakes->id) }}" :title="__('Xóa')" />
            <x-link :href="route('admin.lakes.create')" class="btn btn-green my-1"><i class="ti ti-plus"></i>{{ __('Thêm') }}</x-link>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh hồ') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="avatar" showImage="image" :value="$lakes->avatar" />
        </div>
        <span></span>
    </div>
    <div class="card mb-3">
        <div class="card-header p-2">
            <x-link :href="route('admin.lakes.rating.index', ['lake_id' => $lakes['id']])" class="text-decoration-none">
                <i class="ti ti-menu-2 px-2"></i>
                {{ __('Danh sách đánh giá') }}
            </x-link>
        </div>
        <div class="card-body p-2" class="d-flex align-items-center text-decoration-none mb-2">
            {{ __('Số lượng đánh giá') }}: <strong>{{ $totalRate }}</strong>
            <i class="ti ti-star text-yellow"></i>
        </div>
        <div class="card-body p-2" class="d-flex align-items-center text-decoration-none mb-2">
            {{ __('Đánh giá trung bình') }}: <strong>{{ $avgRate }}</strong>
            <i class="ti ti-star text-yellow"></i>
        </div>

    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select name="status" :required="true">
                @foreach ($status as $key => $value)
                    <x-select-option :option="$lakes->status" :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>
</div>
