<?php
$bookings = App\Models\Bookings::all();
use App\Enums\Bookings\BookingsStatus;

?>
<x-input type="hidden" name="route_search_select_lakechild" :value="route('admin.search.select.lakechild')"/>
<script>
    $(document).ready(function () {
        $('#search-select-lakechild').select2({
            ajax: {
                url: "{{ route('admin.search.select.lakechild') }}",
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.text,
                            compensation: item.compensation
                        }))
                    };
                }
            }
        });

        $('#search-select-lakechild').on('select2:select', function (e) {
            var data = e.params.data;
            window.selectedCompensation = data.compensation || 0;
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const lakechildSelect = document.getElementById('search-select-lakechild');
        const closeDateInput = document.getElementById('close_date');
        const openDateInput = document.getElementById('open_date');

        function calculateAffectedBookings() {
            const lakechildId = lakechildSelect.value;
            const closeDate = new Date(closeDateInput.value);
            const openDate = new Date(openDateInput.value);
            closeDate.setHours(0, 0, 0, 0);
            openDate.setHours(0, 0, 0, 0);

            if (!lakechildId || isNaN(closeDate.getTime()) || isNaN(openDate.getTime())) {
                return;
            }

            const bookings = @json($bookings);

            const affectedBookings = bookings.filter(booking => {
                const bookingDate = new Date(booking.fishing_date);
                bookingDate.setHours(0, 0, 0, 0);
                return booking.lakeChild_id == lakechildId &&
                    bookingDate >= closeDate &&
                    bookingDate < openDate &&
                    (booking.status === 0 || booking.status === 1);
            });
            const canceledBookingsCount = affectedBookings.length;

            const totalRefundAmount = affectedBookings
                .filter(booking => booking.status == 1)
                .reduce((sum, booking) => sum + parseFloat(booking.total_price), 0);

            const compensationPercentage = parseFloat(window.selectedCompensation) || 0;
            const compensationDecimal = compensationPercentage / 100;
            const compensationAmount = totalRefundAmount * compensationDecimal;

            document.getElementById('canceled_bookings').textContent = canceledBookingsCount;
            document.getElementById('total_refund_amount').textContent = totalRefundAmount.toLocaleString('vi-VN');
            document.getElementById('compensation_amount').textContent = compensationAmount.toLocaleString('vi-VN');

            const closeDays = Math.ceil((openDate - closeDate) / (1000 * 60 * 60 * 24));
            document.getElementById('close_days').textContent = closeDays;
        }

        lakechildSelect.addEventListener('change', calculateAffectedBookings);
        closeDateInput.addEventListener('change', calculateAffectedBookings);
        openDateInput.addEventListener('change', calculateAffectedBookings);
        // document.querySelector('form').addEventListener('submit', function() {
        //     const totalRefundAmountInput = document.getElementById('total_refund_amount');
        //     totalRefundAmountInput.textContent = totalRefundAmountInput.textContent.replace(/\./g, '');
        //
        //     const compensationAmountInput = document.getElementById('compensation_amount');
        //     compensationAmountInput.textContent = compensationAmountInput.textContent.replace(/\./g, '');
        // });
    });
</script>


<script>
    $(document).ready(function (e) {
        var routeLakechild = $('input[name="route_search_select_lakechild"]').val();
        select2LoadData(routeLakechild, '#search-select-lakechild');
    });
    document.addEventListener('DOMContentLoaded', function () {
        const openDateInput = document.getElementById('open_date');
        const closeDateInput = document.getElementById('close_date');
        const closeDaysInput = document.getElementById('close_days');

        function calculateCloseDays() {
            const openDateValue = openDateInput.value;
            const closeDateValue = closeDateInput.value;

            if (openDateValue && closeDateValue) {
                const openDate = new Date(openDateValue);
                const closeDate = new Date(closeDateValue);

                // Calculate the difference in time
                const timeDifference = openDate - closeDate;

                // Convert time difference to days
                const dayDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));

                // Set the value of close_days span
                closeDaysInput.textContent = dayDifference;
            }
        }

        openDateInput.addEventListener('change', calculateCloseDays);
        closeDateInput.addEventListener('change', calculateCloseDays);
    });
</script>
