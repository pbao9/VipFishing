<?php

namespace App\Admin\Services\Lakechilds;

use App\Admin\Services\Lakechilds\LakechildsServiceInterface;
use  App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Models\ActivitySchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class LakechildsService implements LakechildsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(LakechildsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();

        // Kiểm tra và xử lý trường 'fishingsets_id'
        $fishingSets = $this->data['fishingsets_id'] ?? [];
        unset($this->data['fishingsets_id']);

        // Tính toán mật độ cá
        if (isset($this->data['fish_volume']) && isset($this->data['area']) && $this->data['area'] != 0) {
            $this->data['fish_density'] = $this->data['fish_volume'] / $this->data['area'];
        } else {
            $this->data['fish_density'] = 0; // hoặc một giá trị mặc định nếu cần thiết
        }

        // Xử lý trường 'open_day'
        if (isset($this->data['open_day']) && is_array($this->data['open_day'])) {
            $this->data['open_day'] = json_encode($this->data['open_day']);
        } else {
            $this->data['open_day'] = json_encode([]); // Hoặc null, tùy thuộc vào yêu cầu của bạn
        }

        // Tạo bản ghi mới
        $lakeChild = $this->repository->create($this->data);

        // Đồng bộ hóa các fishing sets
        $this->repository->syncFishingSets($lakeChild, $fishingSets);

        // Tạo lịch hoạt động cho 3 tháng dựa trên id hồ con
        Artisan::call('create:activity-schedule', [
            'lakeChildId' => $lakeChild->id
        ]);

        return $lakeChild->id;
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        if (isset($this->data['fishingsets_id'])) {
            $fishingSets = $this->data['fishingsets_id'];
            unset($this->data['fishingsets_id']);
        } else {
            $fishingSets = array();
        }
        // Tính toán mật độ cá
        if (isset($this->data['fish_volume']) && isset($this->data['area']) && $this->data['area'] != 0) {
            $this->data['fish_density'] = $this->data['fish_volume'] / $this->data['area'];
        } else {
            $this->data['fish_density'] = 0; // hoặc một giá trị mặc định nếu cần thiết
        }

        if (isset($this->data['open_day']) && is_array($this->data['open_day'])) {
            $this->data['open_day'] = json_encode($this->data['open_day']);
        } else {
            $this->data['open_day'] = json_encode([]); // Hoặc null, tùy thuộc vào yêu cầu của bạn
        }

        $lakeChild = $this->repository->update($this->data['id'], $this->data);
        $this->repository->syncFishingSets($lakeChild, $fishingSets);
        $this->updateActivitySchedules($lakeChild);
        return $lakeChild; // Trả về đối tượng $lakeChild thay vì giá trị 1
    }

    protected function updateActivitySchedules($lakeChild)
    {
        // Lấy ngày đầu tiên của tháng hiện tại
        $startOfMonth = Carbon::now()->firstOfMonth();

        // Lấy các ngày hoạt động từ open_day và chuyển thành mảng
        $activeDays = json_decode($lakeChild->open_day, true) ?? [];

        // Xóa các lịch hoạt động cũ
        ActivitySchedule::where('lake_child_id', $lakeChild->id)->delete();

        // Tạo lịch hoạt động mới cho 3 tháng
        for ($monthOffset = 0; $monthOffset < 3; $monthOffset++) {
            $currentMonth = $startOfMonth->copy()->addMonths($monthOffset);
            for ($i = 0; $i < $currentMonth->daysInMonth; $i++) {
                $currentDay = $currentMonth->copy()->addDays($i);
                $dayOfWeek = $currentDay->dayOfWeekIso; // Giá trị từ 1 đến 7 (t2 đến CN)

                // Kiểm tra nếu ngày hiện tại nằm trong danh sách các ngày hoạt động của hồ con
                if (in_array($dayOfWeek, $activeDays)) {
                    // Tạo mới lịch hoạt động cho ngày hiện tại
                    ActivitySchedule::create([
                        'lake_child_id' => $lakeChild->id,
                        'activity_date' => $currentDay->format('Y-m-d'),
                    ]);
                }
            }
        }
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function updateStatusLakechild($lakeChild, $newStatus) {}
}
