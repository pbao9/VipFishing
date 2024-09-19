<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoBanks') }}</h2>
        </div>
        <div class="row card-body">
            <!-- code -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Code') }} :</label>
                    <x-input name="code" :value="old('code')" placeholder="{{ __('code') }}" />
                </div>
            </div>
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên Ngân hàng') }} :</label>
                    <x-input name="name" :value="old('name')" placeholder="{{ __('Tên ngân hàng') }}" />
                </div>
            </div>
            <!-- shortname -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Shortname') }} :</label>
                    <x-input name="shortname" :value="old('shortname')" placeholder="{{ __('Shortname') }}" />
                </div>
            </div>
        </div>
    </div>
</div>
