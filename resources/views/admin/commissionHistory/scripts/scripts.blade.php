<x-input type="hidden" name="route_search_select_user" :value="route('admin.search.select.user')" />
<x-input type="hidden" name="route_search_select_booking" :value="route('admin.search.select.booking')" />

<script>

    $(document).ready(function (e) {
        var routeUser = $('input[name="route_search_select_user"]').val();
        select2LoadData(routeUser, '#search-select-user');

        var routeBooking = $('input[name="route_search_select_booking"]').val();
        select2LoadData(routeBooking, '#search-select-booking');
    });


</script>