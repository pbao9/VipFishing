<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin danh mục') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên danh mục') }}:</label>
                    <x-input name="name" :value="$category->name" :required="true"
                        placeholder="{{ __('Tên danh mục') }}" />
                </div>
            </div>
            <!-- Danh mục cha -->
            <div class="col-md-12 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Danh mục cha') }}:</label>
                    <x-select class="select2-bs5" name="parent_id">
                        <x-select-option value="" :title="__('Trống')" />
                        @foreach ($categories as $item)
                            <x-select-option :option="$category->parent_id" :value="$item->id" :title="generate_text_depth_tree($item->depth).' '.__($item->name)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- position -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Vị trí') }}:</label>
                    <x-input type="number" name="position" :value="$category->position" :required="true" />
                </div>
            </div>
            <!-- is active -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Trạng thái') }}:</label>
                    <x-select class="select2-bs5" name="is_active" :required="true">
                        <x-select-option :value="true" :title="__('Hoạt động')" />
                        <x-select-option :option="$category->is_active ?: '0'" value="0" :title="__('Tạm ngưng')" />
                    </x-select>
                </div>
            </div>
        </div>
    </div>
</div>