<x-input type="hidden" name="route_search_select_user" :value="route('admin.search.select.user')" />
<x-input type="hidden" name="route_search_select_lakechild" :value="route('admin.search.select.lakechild')" />
<x-input type="hidden" name="route_search_activity_dates" :value="route('admin.search.select.activityDate')" />


<script>
    $(document).ready(function() {
        var routeUser = $('input[name="route_search_select_user"]').val();
        select2LoadData(routeUser, '#search-select-user');

        var routeLakechild = $('input[name="route_search_select_lakechild"]').val();
        select2LoadData(routeLakechild, '#search-select-lakechild');

        const lakeChildSelect = $('#search-select-lakechild');
        const lakeChildContainer = $('#lake-child-container');
        const fishingSetContainer = $('#fishing-set-container');
        const fishingSetSelect = $('#search-select-fishingset');
        const fishingDateInput = $('input[name="fishing_date"]');

        lakeChildSelect.on('select2:select', function(e) {
            var data = e.params.data;
            var lakechildId = data.id;

            lakeChildContainer.addClass('col-md-6');
            fishingSetContainer.addClass('col-md-6').removeClass('d-none');

            fishingSetSelect.empty();
            fishingSetSelect.append('<option value="">Chọn suất câu</option>');

            if (data.fishingSets && Array.isArray(data.fishingSets)) {
                data.fishingSets.forEach(function(fishingSet) {
                    const option = new Option(fishingSet.title, fishingSet.id);
                    $(option).data('data-fishingset', fishingSet);
                    fishingSetSelect.append(option);
                });
            }
            $('#lakechild-name').text(data.name);
            $('#lake-name').text(data.lake.name);
        });

        lakeChildSelect.on('select2:unselect', function() {
            lakeChildContainer.removeClass('col-md-6');
            fishingSetContainer.addClass('d-none').removeClass('col-md-6');

            fishingSetSelect.empty(); // Xóa các tùy chọn hiện tại
            fishingSetSelect.append('<option value="">Chọn suất câu</option>');
            fishingDateInput.attr('disabled', true); // Vô hiệu hóa datepicker khi không chọn hồ
        });

        $('#search-select-user').on('select2:select', function(e) {
            var data = e.params.data;

            $('#user-fullname').text(data.fullname);
            $('#user-phone').text('(' + data.phone + ')');
            $('#user-balance').text(data.balance);
            $('#user-bank-name').text(data.bank_name);
            $('#user-bank-number').text(data.bank_number);
        });

        $('#search-select-fishingset').on('change', function(e) {
            const selectedOption = $(this).find('option:selected');
            const value = selectedOption.val();

            if (value === "") {
                $('#fishingset-time-start').text('??:??');
                $('#fishingset-time-end').text('??:??');
                $('#fishingset-duration').text('?h');
                return;
            }

            const dataFishingset = selectedOption.data('data-fishingset');

            function removeSeconds(time) {
                return time.slice(0, 5);
            }

            $('#fishingset-time-start').text(removeSeconds(dataFishingset.time_start));
            $('#fishingset-time-end').text(removeSeconds(dataFishingset.time_end));
            $('#fishingset-duration').text(dataFishingset.duration + 'h');
        });
    });
</script>
