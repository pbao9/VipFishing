<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([1, 2, 4, 5, 6]).every(function() {
            var column = this;
            var input = document.createElement("input");
            input.setAttribute('class', 'form-control');
            if (column.selector.cols == 6) {
                input.setAttribute('type', 'date');
            } else if (column.selector.cols == 2) {
                input = document.createElement("select");
                createSelectColumnUniqueDatatableAll(input, @json($in_stock));
            } else if (column.selector.cols == 4) {
                input = document.createElement("select");
                createSelectColumnUniqueDatatableAll(input, @json($is_user_discount));
            } else if (column.selector.cols == 5) {
                input = document.createElement("select");
                createSelect2ColumnCategory(input, @json($categories));
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
        columns = window.LaravelDataTables["productTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>
