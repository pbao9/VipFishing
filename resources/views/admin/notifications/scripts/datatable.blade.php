<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3, 4]).every(function () {
            var column = this;
            var input = document.createElement("input");
            if(column.selector.cols == 2){
                input = document.createElement("select");
                createSelectColumnUniqueDatatableAll(input, @json($status));
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
        columns = window.LaravelDataTables["notificationsTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>