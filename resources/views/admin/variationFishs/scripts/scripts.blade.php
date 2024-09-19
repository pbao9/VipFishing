<x-input type="hidden" name="route_search_select_fishs" :value="route('admin.search.select.fishs')" />

<script>
    
    $(document).ready(function(e){
        select2LoadData($('input[name="route_search_select_fishs"]').val());
      
    });
   
  
</script>
