<x-input type="hidden" name="route_search_select_rank" :value="route('admin.search.select.rank')" />
<x-input type="hidden" name="route_search_select_bank" :value="route('admin.search.select.bank')" />

<script>

    $(document).ready(function (e) {
        var routeRank = $('input[name="route_search_select_rank"]').val();
        select2LoadData(routeRank, '#search-select-rank');

        var routeBank = $('input[name="route_search_select_bank"]').val();
        select2LoadData(routeBank, '#search-select-bank');
    });


</script>