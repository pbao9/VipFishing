<?php

namespace App\Console\Commands;

use App\Enums\Lakechilds\LakechildsStatus;
use App\Models\ActivitySchedule;
use App\Models\Lakechilds;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateQuarterlyActivitySchedules extends Command
{
    protected $signature = 'create:quarterly-activity-schedules';
    protected $description = 'Create 3 months of activity schedules for all active child ponds';

    public function handle()
    {
        $startOfMonth = Carbon::now()->firstOfMonth();

        $lakeChilds = Lakechilds::where('status', LakechildsStatus::active)->get();

        $success = true;

        foreach ($lakeChilds as $lakeChild) {
            $activeDays = json_decode($lakeChild->open_day, true) ?? [];

            for ($monthOffset = 0; $monthOffset < 3; $monthOffset++) {
                $currentMonth = $startOfMonth->copy()->addMonths($monthOffset);
                for ($i = 0; $i < $currentMonth->daysInMonth; $i++) {
                    $currentDay = $currentMonth->copy()->addDays($i);
                    $dayOfWeek = $currentDay->dayOfWeekIso; // Giá trị từ 1 đến 7 (t2 đến CN)

                    if (in_array($dayOfWeek, $activeDays)) {
                        $existingSchedule = ActivitySchedule::where('lake_child_id', $lakeChild->id)
                            ->where('activity_date', $currentDay->format('Y-m-d'))
                            ->first();

                        if (!$existingSchedule) {
                            try {
                                ActivitySchedule::create([
                                    'lake_child_id' => $lakeChild->id,
                                    'activity_date' => $currentDay->format('Y-m-d'),
                                ]);
                            } catch (\Exception $e) {
                                $this->error("Failed to create schedule for  Lake Child ID:: {$lakeChild->id} on {$currentDay->format('Y-m-d')}. Error: {$e->getMessage()}");
                                $success = false;
                            }
                        } else {
                            $this->info("Schedule already exists for Lake Child ID: {$lakeChild->id} on {$currentDay->format('Y-m-d')}. Skipping...");
                        }
                    }
                }
            }
        }

        if ($success) {
            $this->info('Activity schedules for 3 months have been created successfully.');
            Log::info('Activity schedules for 3 months have been created successfully.');
            return 0;
        } else {
            return 1;
        }
    }
}
