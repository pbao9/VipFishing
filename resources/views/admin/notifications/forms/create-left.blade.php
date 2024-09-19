<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoNotifications') }}</h2>
        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tiêu đề') }} :</label>
                    <x-input name="title" :value="old('title')" placeholder="{{ __('Tiêu đề') }}" />
                </div>
            </div><!-- content -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Nội dung') }} :</label>
                    <x-textarea name="content">{{ old('content') }}</x-textarea>
                </div>
            </div><!-- status -->

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã người dùng') }}:</label>
                    <x-select class="select2-bs5-ajax" id="search-select-user" name="user_id" :data-url="route('admin.search.select.user')"
                        :required="true" :multiple="true"></x-select>
                </div>
            </div>

        </div>
    </div>
</div>
