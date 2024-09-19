<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]).every(function () {
            var column = this;
            var input = document.createElement("input");
            if (column.selector.cols == 6 || column.selector.cols == 7) {
                input.setAttribute('type', 'date');
            } else if (column.selector.cols == 8) {
                input = document.createElement("select");
                var jsonOption = {
                    0: "Không",
                    1: "Có"
                }
                createSelectColumnUniqueDatatableAll(input, jsonOption);
            } else if (column.selector.cols == 13) {
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
    $(document).ready(function () {
        // define columns for the datatables
        columns = window.LaravelDataTables["eventsTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>