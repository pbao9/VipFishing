<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const timeStartInput = document.getElementById('time_start');
        const timeEndInput = document.getElementById('time_end');
        const durationInput = document.getElementById('duration');

        function calculateDuration() {
            const timeStart = timeStartInput.value;
            const timeEnd = timeEndInput.value;

            if (timeStart && timeEnd) {
                const [startHours, startMinutes] = timeStart.split(':').map(Number);
                const [endHours, endMinutes] = timeEnd.split(':').map(Number);

                let startTime = new Date();
                startTime.setHours(startHours, startMinutes, 0);

                let endTime = new Date();
                endTime.setHours(endHours, endMinutes, 0);

                // Tính toán sự khác biệt thời gian bằng phút
                let durationInMinutes = (endTime - startTime) / 60000;

                if (durationInMinutes > 0) {
                    const durationInHours = Math.floor(durationInMinutes / 60); // Chỉ lấy phần giờ nguyên
                    durationInput.value = durationInHours;
                } else {
                    durationInput.value = '0';
                }
            } else {
                durationInput.value = '';
            }
        }

        timeStartInput.addEventListener('change', calculateDuration);
        timeEndInput.addEventListener('change', calculateDuration);
    });
</script>
