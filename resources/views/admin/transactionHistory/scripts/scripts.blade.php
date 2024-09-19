<x-input type="hidden" name="route_search_select_user" :value="route('admin.search.select.user')" />

<script>

    $(document).ready(function (e) {
        var routeUser = $('input[name="route_search_select_user"]').val();
        select2LoadData(routeUser, '#search-select-user');
    });


</script>