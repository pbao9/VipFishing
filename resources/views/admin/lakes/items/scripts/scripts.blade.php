<x-input type="hidden"  name="route_search_select_lakes" :value="route('admin.search.select.lakes')" />
<x-input type="hidden"  name="route_search_select_fishs" :value="route('admin.search.select.fishs')" />

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: "{{ __('Chọn ngày trong tuần') }}",
            allowClear: true,
            language: "vi",
            theme: 'bootstrap-5',
        });
    });
    $(document).ready(function(e){
        var routeLakes = $('input[name="route_search_select_lakes"]').val();
        var routeFishs = $('input[name="route_search_select_fishs"]').val();
        select2LoadData(routeLakes, '#lakesSelect');
        select2LoadData(routeFishs, '#fishsSelect');
    });
</script>
