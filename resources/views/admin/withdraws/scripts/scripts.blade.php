<x-input type="hidden" name="route_search_select_user" :value="route('admin.search.select.user')" />
<x-input type="hidden" name="route_search_select_admin" :value="route('admin.search.select.admin')" />
<x-input type="hidden" name="route_search_select_bank" :value="route('admin.search.select.bank')" />

<script>

    $(document).ready(function (e) {
        var routeUser = $('input[name="route_search_select_user"]').val();
        select2LoadData(routeUser, '#search-select-user');

        var routeAdmin = $('input[name="route_search_select_admin"]').val();
        select2LoadData(routeAdmin, '#search-select-admin');

        var routeBank = $('input[name="route_search_select_bank"]').val();
        select2LoadData(routeBank, '#search-select-bank');

        $('#other-bank-select').on('change', function () {
            if ($(this).val() == '1') { // 'Có' được chọn
                $('.toggle-target').removeClass('d-none');
            } else { // 'Không' được chọn
                $('.toggle-target').addClass('d-none');
            }
        });

        // Khởi tạo giá trị ban đầu
        if ($('#other-bank-select').val() == '1') {
            $('.toggle-target').removeClass('d-none');
        }

        $('#search-select-user').on('select2:select', function (e) {
            var data = e.params.data;

            console.log(data);
            $('#user-fullname').text(data.fullname);
            $('#user-phone').text('(' + data.phone + ')');
            $('#user-balance').text(data.balance);
            $('#user-bank-name').text(data.bank_name);
            $('#user-bank-number').text(data.bank_number);
        });
    });


</script>