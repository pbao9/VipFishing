<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([1, 2, 3, 4]).every(function () {
            var column = this;
            var input = document.createElement("input");
            input.setAttribute('class', 'form-control');
            
            if(column.selector.cols == 2){
                input = document.createElement("select");
                createSelectColumnUniqueDatatableAll(input, @json($status));
            }else if(column.selector.cols == 3){
                input = document.createElement("select");
                createSelectColumnUniqueDatatableAll(input, @json($is_featured));
            }else if(column.selector.cols == 4){
                input.setAttribute('type', 'date');
            }
    
            input.setAttribute('placeholder', 'Nhập từ khóa');
    
            $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
        }); 
    }
    $(document).ready(function() {
        // define columns for the datatables
        columns = window.LaravelDataTables["postTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>