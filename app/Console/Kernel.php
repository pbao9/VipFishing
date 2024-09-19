<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel

{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\UpdateLakechildStatus::class,
        Commands\CreateQuarterlyActivitySchedules::class,
        Commands\CreateActivityScheduleForLakeChild::class
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('lakechild:update-status')->daily();
        // 0 0 1 */3 *: cron này sẽ chạy vào lúc 00:00 ngày 1 của tháng đầu tiên mỗi 3 tháng (tức là tháng 1, tháng 4, tháng 7, tháng 10)
        $schedule->command('create:quarterly-activity-schedules')->cron('0 0 1 */3 *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
