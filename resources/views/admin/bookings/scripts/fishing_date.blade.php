<script>
    $(document).ready(function() {
        var routeActivity = $('input[name="route_search_activity_dates"]').val();
        const lakeChildSelect = $('#search-select-lakechild');
        const availableDate = $('#availableDate');

        var customLocale = {
            code: 'vi',
            buttonText: {
                today: 'Hôm nay',
                month: 'Tháng',
                week: 'Tuần',
                day: 'Ngày',
                list: 'Danh sách'
            },
            weekText: 'Tuần',
            allDayText: 'Cả ngày',
            moreLinkText: function(n) {
                return '+ Thêm ' + n;
            },
            noEventsText: 'Không có sự kiện để hiển thị'
        };

        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            buttonText: customLocale.buttonText,
            locale: 'vi',
            events: [],
            eventColor: '#007bff',
            dateClick: function(info) {
                document.querySelectorAll('.fc-daygrid-day').forEach(day => {
                    day.classList.remove('selected-date');
                });

                info.dayEl.classList.add('selected-date');

                $('input[name="fishing_date"]').val(info.dateStr);
                availableDate.text('Ngày đã chọn: ' + info.dateStr);
            }
        });

        calendar.render();
        $(calendarEl).addClass('d-none');

        lakeChildSelect.on('select2:select', function(e) {
            var data = e.params.data;
            var lakechildId = data.id;

            $.ajax({
                url: routeActivity,
                type: 'GET',
                data: {
                    lake_child_id: lakechildId
                },
                success: function(response) {
                    if (response.results && Array.isArray(response.results) && response
                        .results.length > 0) {
                        $(calendarEl).removeClass('d-none').addClass('d-block');
                        calendar.getEvents().forEach(event => event.remove());

                        const eventDays = new Set(response.results.map(item => item.text
                            .split(' - ')[0]));

                        var months = new Set(response.results.map(item => {
                            return new Date(item.text.split(' - ')[0])
                                .toISOString().slice(0, 7);
                        }));

                        var allDays = new Set();

                        months.forEach(function(month) {
                            var [year, monthIndex] = month.split('-').map(Number);
                            var lastDayOfMonth = new Date(year, monthIndex, 0)
                                .getDate();

                            for (var day = 1; day <= lastDayOfMonth; day++) {
                                var dateStr = year + '-' +
                                    ('0' + monthIndex).slice(-2) + '-' +
                                    ('0' + day).slice(-2);

                                allDays.add(
                                    dateStr
                                );
                            }
                        });

                        const events = response.results.map(item => ({
                            id: item.id,
                            title: item.text,
                            start: item.text.split(' - ')[0],
                            allDay: true
                        }));
                        calendar.addEventSource(events);

                        allDays.forEach(function(dateStr) {
                            if (!eventDays.has(dateStr)) {
                                calendar.addEvent({
                                    title: 'Không hoạt động',
                                    start: dateStr,
                                    color: '#f59f00'
                                });
                            }
                        });

                    } else {
                        $(calendarEl).removeClass('d-block').addClass('d-none');
                        availableDate.text('Hồ không có lịch hoạt động!');
                    }
                },
                error: function() {
                    $(calendarEl).removeClass('d-block').addClass('d-none');
                }
            });
        });

        lakeChildSelect.on('select2:unselect', function() {
            calendar.getEvents().forEach(event => event.remove());
            $(calendarEl).removeClass('d-block').addClass('d-none');
        });
    });
</script>
