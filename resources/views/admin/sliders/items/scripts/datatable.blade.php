<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 3]).every(function () {
            var column = this;
            var input = document.createElement("input");
            if(column.selector.cols == 3){
                input.setAttribute('type', 'date');
            }
    
            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');
    
            $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
        }); 
    }
    $(document).ready(function() {
        // define columns for the datatables
        columns = window.LaravelDataTables["sliderItemTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>