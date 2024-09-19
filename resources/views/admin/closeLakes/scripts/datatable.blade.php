<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([1, 2, 3, 4, 5, 6, 7, 8]).every(function () {
            var column = this;
            var input = document.createElement("input");
            if (column.index() == 2 || column.index() == 3) {
                input.setAttribute('type', 'date');
            }

            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');

            $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    // Chuyển đổi định dạng ngày từ yyyy-mm-dd sang dd-mm-yyyy
                    if (input.type === 'date') {
                        var date = new Date($(this).val());
                        var formattedDate = ('0' + date.getDate()).slice(-2) + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + date.getFullYear();
                        column.search(formattedDate).draw();
                    } else {
                        column.search($(this).val(), false, false, true).draw();
                    }
                });
        });
    }

    $(document).ready(function () {
        // define columns for the datatables
        columns = window.LaravelDataTables["closeLakesTable"].columns();
        toggleColumnsDatatable(columns);
        searchColumsDataTable(window.LaravelDataTables["closeLakesTable"]);
    });
</script>
