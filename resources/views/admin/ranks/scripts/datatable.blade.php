<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3, 4, 5, 6, 7, 8,9]).every(function () {
            var column = this;
            var input = document.createElement("input");
            if(column.selector.cols != 0 && column.selector.cols != 7 && column.selector.cols != 9){
                input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            }else if(column.selector.cols == 7){
                input = document.createElement("select");
                var options = [
                { display: 'Tất cả', value: '' },
                { display: 'Đang nhận hoa hồng', value: '1' },
                { display: 'Không nhận hoa hồng', value: '2' }
                ];
                options.forEach(function(option) {
                    var opt = document.createElement("option");
                    opt.value = option.value;
                    opt.textContent = option.display;
                    input.appendChild(opt);
                });
                input.setAttribute('class', 'form-control');
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            }else if(column.selector.cols == 0){
                input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            }
            // else if (column.selector.cols == 7) {
            //     input = document.createElement("select");
            //     var myOptions = ["on", "off"];
            //     generateSelectOptions(input, myOptions);
            // }
            
            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');
    
            
        }); 
    }
    $(document).ready(function() {
        // define columns for the datatables
        columns = window.LaravelDataTables["ranksTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>