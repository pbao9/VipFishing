<x-input type="hidden" name="route_search_select_provinces" :value="route('admin.search.select.provinces')" />

<script>

    $(document).ready(function(e){
        select2LoadData($('input[name="route_search_select_provinces"]').val());

    });


</script>
