<?php

namespace App\Console\Commands;

use App\Models\CloseLakes;
use Illuminate\Console\Command;
use App\Enums\Lakechilds\LakechildsStatus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateLakechildStatus extends Command
{
    protected $signature = 'lakechild:update-status';
    protected $description = 'Update lakechild status to open if open_date is today';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Lấy ngày hiện tại
        $today = Carbon::today();

        // Tìm các hồ cần mở cửa hôm nay
        $closeLakes = CloseLakes::where('open_date', '=', $today)->get();

        foreach ($closeLakes as $closeLake) {
            $lakeChild = $closeLake->lakechild;
            if ($lakeChild->status != LakechildsStatus::active) {
                $lakeChild->status = LakechildsStatus::active;
                $lakeChild->save();
                Log::info("Lakechild (ID: {$lakeChild->id}) status updated to open.");
            }
        }

        // Tìm các hồ cần đóng cửa hôm nay
        $closeLakesToClose = CloseLakes::where('close_date', '=', $today)->get();
        foreach ($closeLakesToClose as $closeLake) {
            $lakeChild = $closeLake->lakechild;
            if ($lakeChild->status != LakechildsStatus::closed) {
                $lakeChild->status = LakechildsStatus::closed;
                $lakeChild->save();
                Log::info("Lakechild (ID: {$lakeChild->id}) status updated to closed.");
            }
        }

        $this->info('Lakechild statuses updated successfully.');
    }
}
