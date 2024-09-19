<script>
    document.addEventListener('DOMContentLoaded', function() {
        var activityDates = @json($lakechilds->activityDates);

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

        var events = activityDates.map(function(item) {
            return {
                title: 'Hoạt động',
                start: item.activity_date
            };
        });

        var months = new Set(activityDates.map(function(item) {
            return new Date(item.activity_date).toISOString().slice(0, 7); // "YYYY-MM" format
        }));

        months.forEach(function(month) {
            var [year, monthIndex] = month.split('-').map(Number);
            var lastDayOfMonth = new Date(year, monthIndex, 0).getDate();

            for (var day = 1; day <= lastDayOfMonth; day++) {
                var dateStr = year + '-' +
                    ('0' + monthIndex).slice(-2) + '-' +
                    ('0' + day).slice(-2);

                var hasEvent = events.some(function(event) {
                    return event.start === dateStr;
                });

                if (!hasEvent) {
                    events.push({
                        title: 'Không hoạt động',
                        start: dateStr,
                        color: '#f59f00'
                    });
                }
            }
        });

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            editable: false,
            locale: 'vi',
            buttonText: customLocale.buttonText,
            events: events
        });

        document.querySelector('a[href="#tabs-activity"]').addEventListener('shown.bs.tab', function() {
            calendar.render();
        });
    });
</script>
