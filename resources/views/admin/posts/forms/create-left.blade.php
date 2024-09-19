<div class="col-12 col-md-9">
    <div class="row">
        <!-- name -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Tiêu đề') }}:</label>
                <x-input name="title" :value="old('title')" :required="true" placeholder="{{ __('Tiêu đề') }}" />
            </div>
        </div>

        <!-- desc -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mô tả') }}:</label>
                <textarea name="content" class="ckeditor visually-hidden">{{ old('content') }}</textarea>
            </div>
        </div>
        <!-- excerpt -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mô tả ngắn') }}:</label>
                <textarea class="form-control" name="excerpt" rows="5">{{ old('excerpt') }}</textarea>
            </div>
        </div>
    </div>
</div>
