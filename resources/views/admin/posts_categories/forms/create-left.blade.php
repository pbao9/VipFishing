<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin chuyên mục') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên chuyên mục') }}:</label>
                    <x-input name="name" :value="old('name')" :required="true"
                        placeholder="{{ __('Tên chuyên mục') }}" />
                </div>
            </div>
            <!-- chuyên mục cha -->
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('chuyên mục cha') }}:</label>
                    <x-select class="select2-bs5" name="parent_id">
                        <x-select-option value="" :title="__('Trống')" />
                        @foreach ($categories as $category)
                            <x-select-option :value="$category->id" :title="generate_text_depth_tree($category->depth).' '.__($category->name)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- position -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Vị trí') }}:</label>
                    <x-input type="number" name="position" :value="old('position', 0)" :required="true" />
                </div>
            </div>
            <!-- is active -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Trạng thái') }}:</label>
                    <x-select name="status" :required="true">
                        @foreach ($status as $key => $value)
                            <x-select-option :value="$key" :title="$value" />
                        @endforeach
                    </x-select>
                </div>
            </div>
        </div>
    </div>
</div>