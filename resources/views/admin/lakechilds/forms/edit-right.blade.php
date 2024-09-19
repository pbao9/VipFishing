<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex align-items-center justify-content-between flex-wrap">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete
                data-route="{{ route('admin.lakes.item.delete', ['lake_id' => $sliderItem->lake_id ?? 0, 'id' => $lakechilds->id]) }}"
                :title="__('Xóa')" />
            <x-link :href="route('admin.lakes.item.create', $lakechilds->lake_id)" class="btn btn-green my-1"><i
                    class="ti ti-plus"></i>{{ __('Thêm') }}</x-link>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select name="status">
                @if ($lakechilds->status == 1)
                    <option value="1" selected>Hoạt động</option>
                    <option value="2">Tạm ngưng</option>
                @else
                    <option value="1">Hoạt động</option>
                    <option value="2" selected>Tạm ngưng</option>
                @endif
            </x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Mã nhà hồ') }}
        </div>
        <div class="card-body p-2">
            <x-select class="select2-bs5-ajax" name="lake_id" id="lakesSelect" :required="true">
                <x-select-option :option="$lakechilds->lake->id" :value="$lakechilds->lake->id"
                    :title="$lakechilds->lake->name" />
            </x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Mã cá') }}
        </div>
        <div class="card-body p-2">
            <x-select class="select2-bs5-ajax" name="fish_id" id="fishsSelect" :required="true">
                <x-select-option :option="$lakechilds->fish->id" :value="$lakechilds->fish->id"
                    :title="$lakechilds->fish->name" />
            </x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Suất câu') }}
        </div>
        <div class="card-body p-2 wrap-list-checkbox">
            @foreach ($fishingSets as $fishingSet)
                        @php
                            // Kiểm tra xem ID của fishingSet hiện tại có nằm trong danh sách fishingSets của lakechild hay không
                            $checked = in_array($fishingSet->id, $lakechilds->fishingSets->pluck('id')->toArray());
                        @endphp
                        <x-input-checkbox :checked="[$checked ? $fishingSet->id : '']" name="fishingsets_id[]"
                            :label="$fishingSet->title" :value="$fishingSet->id" />
            @endforeach

            {{-- <div class="card mb-3"> --}}
                {{-- <div class="card-header"> --}}
                    {{-- {{ __('Tiện ích') }} --}}
                    {{-- </div> --}}
                {{-- <div class="card-body p-2 wrap-list-checkbox"> --}}
                    {{-- @foreach ($fishingSets as $fishingSet) --}}
                    {{-- <x-input-checkbox --}} {{-- :checked="$lakechilds->$fishingSets->pluck('id')->toArray()" --}}
                        {{-- name="fishingset_id[]" --}} {{-- :label="$fishingSet->title" --}} {{--
                        :value="$fishingSet->id" /> --}}
                    {{-- @endforeach --}}
                    {{-- </div> --}}
                {{-- </div> --}}
        </div>
    </div>
</div>