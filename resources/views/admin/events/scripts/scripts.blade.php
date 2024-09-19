<x-input type="hidden" name="route_search_select_user" :value="route('admin.search.select.user')" />
<x-input type="hidden" name="route_search_select_rank" :value="route('admin.search.select.rank')" />
<x-input type="hidden" name="route_search_select_lakechild" :value="route('admin.search.select.lakechild')" />

<script>

    $(document).ready(function (e) {
        var routeUser = $('input[name="route_search_select_user"]').val();
        select2LoadData(routeUser, '#search-select-user');

        var routeRank = $('input[name="route_search_select_rank"]').val();
        select2LoadData(routeRank, '#search-select-rank');

        var routeLakechild = $('input[name="route_search_select_lakechild"]').val();
        select2LoadData(routeLakechild, '#search-select-lakechild');

        $('#events-condition-select').on('change', function () {
            if ($(this).val() == '1') { // 'Có' được chọn
                $('.toggle-target').removeClass('d-none');
            } else { // 'Không' được chọn
                $('.toggle-target').addClass('d-none');
            }
        });

        // Khởi tạo giá trị ban đầu
        if ($('#events-condition-select').val() == '1') {
            $('.toggle-target').removeClass('d-none');
        }
    });

</script>