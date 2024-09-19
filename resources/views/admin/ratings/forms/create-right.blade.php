<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Hài lòng') }}
        </div>
        <div class="card-body p-2">
            <x-select class="form-select" name="status" :required="true">
                @foreach($rateStatus as $key => $value)
                    <x-select-option value="{{ $key }}" :title="__($value)" />
                @endforeach
            </x-select>
        </div>

    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh đánh giá') }}
        </div>
        <div class="card-body p-2">
            <x-input-gallery-ckfinder name="picture" type="multiple" :value="$ratings->first()->picture ?? ''"/>
        </div>
    </div>
</div>
