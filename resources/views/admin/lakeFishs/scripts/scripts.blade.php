<x-input type="hidden"  name="route_search_select_lakechilds" :value="route('admin.search.select.lakechilds')" />
<x-input type="hidden"  name="route_search_select_fishs" :value="route('admin.search.select.fishs')" />

<script>
    $(document).ready(function(e){
        var routeLakechilds = $('input[name="route_search_select_lakechilds"]').val();
        var routeFishs = $('input[name="route_search_select_fishs"]').val();
        select2LoadData(routeLakechilds, '#lakechildsSelect'); 
        select2LoadData(routeFishs, '#fishsSelect'); 
    });
</script>
