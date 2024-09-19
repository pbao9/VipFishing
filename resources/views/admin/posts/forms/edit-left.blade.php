<div class="col-12 col-md-9">
    <div class="row">
        <!-- name -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Tiêu đề') }}:</label>
                <x-input name="title" :value="$post->title" :required="true" placeholder="{{ __('Tiêu đề') }}" />
            </div>
        </div>

        <!-- desc -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mô tả') }}:</label>
                <textarea name="content" class="ckeditor visually-hidden">{{ $post->content }}</textarea>
            </div>
        </div>
        <!-- excerpt -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mô tả ngắn') }}:</label>
                <textarea class="form-control" name="excerpt" rows="5">{{ $post->excerpt }}</textarea>
            </div>
        </div>
    </div>
</div>
