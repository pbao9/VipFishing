<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3, 5]).every(function() {
            var column = this;
            var input = document.createElement("input");
            input.setAttribute('class', 'form-control');
            if (column.selector.cols == 5) {
                input.setAttribute('type', 'date');
            } else if (column.selector.cols == 3) {
                input = document.createElement("select");
                createSelectColumnUniqueDatatableAll(input, @json($status));
            }

            input.setAttribute('placeholder', 'Nhập từ khóa');
            

            $(input).appendTo($(column.footer()).empty())
                .on('change', function() {
                    column.search($(this).val(), false, false, true).draw();
                });
        });
    }
    $(document).ready(function() {
        // define columns for the datatables
        columns = window.LaravelDataTables["orderTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>
