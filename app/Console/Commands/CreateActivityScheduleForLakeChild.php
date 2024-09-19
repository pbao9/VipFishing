<?php

namespace App\Console\Commands;

use App\Enums\Lakechilds\LakechildsStatus;
use App\Models\ActivitySchedule;
use App\Models\Lakechilds;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateActivityScheduleForLakeChild extends Command
{
    protected $signature = 'create:activity-schedule {lakeChildId}';
    protected $description = 'Create activity schedules for a specific child pond';

    public function handle()
    {
        $lakeChildId = $this->argument('lakeChildId');
        $lakeChild = Lakechilds::find($lakeChildId);

        if (!$lakeChild) {
            $this->error("Child Pond ID: {$lakeChildId} not found.");
            return 1;
        }

        $currentDay = Carbon::now();

        $activeDays = json_decode($lakeChild->open_day, true) ?? [];
        $success = true;

        for ($monthOffset = 0; $monthOffset < 12; $monthOffset++) {
            $currentMonth = $currentDay->copy()->addMonths($monthOffset);

            $startDay = ($monthOffset === 0) ? $currentDay->day : 1;

            for ($day = $startDay; $day <= $currentMonth->daysInMonth; $day++) {
                $scheduleDay = $currentMonth->copy()->day($day);
                $dayOfWeek = $scheduleDay->dayOfWeekIso; // Giá trị từ 1 đến 7 (t2 đến CN)

                if (in_array($dayOfWeek, $activeDays)) {
                    $existingSchedule = ActivitySchedule::where('lake_child_id', $lakeChild->id)
                        ->where('activity_date', $scheduleDay->format('Y-m-d'))
                        ->first();

                    if (!$existingSchedule) {
                        try {
                            ActivitySchedule::create([
                                'lake_child_id' => $lakeChild->id,
                                'activity_date' => $scheduleDay->format('Y-m-d'),
                            ]);
                        } catch (\Exception $e) {
                            $this->error("Failed to create schedule for LakeChild ID: {$lakeChild->id} on {$scheduleDay->format('Y-m-d')}. Error: {$e->getMessage()}");
                            $success = false;
                        }
                    } else {
                        $this->info("Schedule already exists for LakeChild ID: {$lakeChild->id} on {$scheduleDay->format('Y-m-d')}. Skipping...");
                    }
                }
            }
        }

        if ($success) {
            $this->info('Activity schedules for 12 months have been created successfully.');
            return 0;
        } else {
            return 1;
        }
    }
}
