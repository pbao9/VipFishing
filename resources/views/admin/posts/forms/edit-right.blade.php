<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.post.delete', $post->id) }}" :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Danh mục') }}
        </div>
        <div class="card-body p-2 wrap-list-checkbox">
            @foreach ($categories as $category)
                <x-input-checkbox :checked="$post->categories->pluck('id')->toArray()" :depth="$category->depth" name="categories_id[]" :label="$category->name" :value="$category->id"/>
            @endforeach
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Nổi bật') }}
        </div>
        <div class="card-body p-2">
            <x-input-switch :checked="$post->is_featured" name="is_featured" value="1" :label="__('Nổi bật?')"/>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select name="status" :required="true">
                @foreach ($status as $key => $value)
                    <x-select-option :option="$post->status->value" :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>
    
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh đại diện') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="image" showImage="image" :value="$post->image"/>
        </div>
    </div>
</div>