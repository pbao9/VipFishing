<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('infoBooking') }}</h2>
        </div>
        <div class="row card-body">
            <!-- fishing_date -->
            {{-- <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày câu') }} :</label>
                    <x-input type="date" name="fishing_date" :value="old('fishing_date')" placeholder="{{ __('Ngày câu') }}"
                        :required="true" />
                </div>
            </div> --}}
            <!-- user_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Người dùng') }}:</label>
                    <div class="mb-3">
                        <p class="mb-1">
                            <strong id="user-fullname">Tên người dùng</strong>
                            <span id="user-phone" class="text-muted">(Số điện thoại)</span>
                            <strong> - Số dư:</strong>
                            <strong id="user-balance" class="text-success">Số dư</strong>
                        </p>
                        <p class="mb-1">
                            <strong>Thông tin ngân hàng:</strong>
                            <strong id="user-bank-name" class="text-primary">Tên ngân hàng</strong>
                        </p>
                        <p class="mb-1">
                            <strong>Số tài khoản:</strong>
                            <strong id="user-bank-number" class="text-primary">Số tài khoản</strong>
                        </p>
                    </div>
                    <x-select class="select2-bs5-ajax" id="search-select-user" name="user_id" :data-url="route('admin.search.select.user')"
                        :required="true"></x-select>
                </div>
            </div>

            <!-- lakeChild_id -->
            <div class="col-12" id="lake-child-container">
                <div class="mb-3">
                    <label class="control-label">
                        <strong>{{ __('Hồ lẻ') }}:</strong> <span id="lakechild-name" class="text-success">Hồ
                            lẻ</span>
                        - Hồ: <span id="lake-name" class="text-primary">Hồ</span>
                    </label>
                    <x-select class="select2-bs5-ajax" style="width: 100% !important;" id="search-select-lakechild"
                        name="lakeChild_id" :data-url="route('admin.search.select.lakechild')" :required="true"></x-select>
                </div>
            </div>
            <!-- fishingset_id -->
            <div class="col-12 d-none" id="fishing-set-container">
                <div class="mb-3">
                    <label class="control-label">
                        <strong>{{ __('Suất câu') }}:</strong>
                        - Bắt đầu: <span id="fishingset-time-start" class="text-primary">??:??</span>
                        - Kết thúc: <span id="fishingset-time-end" class="text-primary">??:??</span>
                        - Độ dài: <span id="fishingset-duration" class="text-secondary">?h</span>
                    </label>
                    <x-select id="search-select-fishingset" name="fishingset_id" :required="true"></x-select>
                </div>
            </div>

            <!-- activity_day -->
            <span id="availableDate" class="fw-bold mb-3"></span>
            <div class="col-12" id="activity-day-container">
                <div class="mb-3">
                    <div id="calendar"></div>
                    <input type="hidden" name="fishing_date">
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .selected-date {
        background-color: #8a97ab;
        color: white;
    }

    .fc-toolbar-title,
    .fc-daygrid-day-number,
    .fc-daygrid-day-top,
    .fc-daygrid-day-bottom,
    .fc-event-title {
        text-transform: uppercase;
    }

    .fc-col-header-cell,
    .fc-col-header-cell-cushion {
        text-transform: uppercase;
    }
</style>
