<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2]).every(function() {
            var column = this;
            var input = document.createElement("input");

            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');

            $(input).appendTo($(column.footer()).empty())
                .on('change', function() {
                    column.search($(this).val(), false, false, true).draw();
                });
        });
    }
    $(document).ready(function() {
        // define columns for the datatables
        columns = window.LaravelDataTables["ratingsTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>
