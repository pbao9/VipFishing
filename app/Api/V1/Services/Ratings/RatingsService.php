<?php

namespace App\Api\V1\Services\Ratings;

use App\Admin\Services\File\FileService;
use App\Admin\Services\File\GalleryService;
use App\Api\V1\Repositories\Bookings\BookingsRepositoryInterface;
use App\Api\V1\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Api\V1\Repositories\Lakes\LakesRepositoryInterface;
use App\Api\V1\Services\Ratings\RatingsServiceInterface;
use App\Api\V1\Repositories\Ratings\RatingsRepositoryInterface;
use App\Api\V1\Repositories\UserScores\UserScoresRepositoryInterface;
use App\Enums\Bookings\BookingsStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Api\V1\Support\AuthSupport;
use Illuminate\Support\Facades\Log;

class RatingsService implements RatingsServiceInterface
{
    use AuthSupport;

    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $bookingRepository;
    protected $lakeRepository;
    protected $lakeChildRepository;
    protected GalleryService $fileService;
    protected $userScoreRepository;

    public function __construct(
        RatingsRepositoryInterface $repository,
        BookingsRepositoryInterface $bookingRepository,
        LakechildsRepositoryInterface $lakechildsRepository,
        LakesRepositoryInterface $lakeRepository,
        GalleryService $fileService,
        UserScoresRepositoryInterface $userScoreRepository
    ) {
        $this->repository = $repository;
        $this->bookingRepository = $bookingRepository;
        $this->lakeRepository = $lakeRepository;
        $this->lakeChildRepository = $lakechildsRepository;
        $this->fileService = $fileService;
        $this->userScoreRepository = $userScoreRepository;
    }

    public function add(Request $request)
    {
        $this->data = $request->validated();
        $user = $request->user();
        $userId = $user->id;

        $existingRating = $this->repository->where('booking_id', '=', $this->data['booking_id'])->first();

        $booking = $this->bookingRepository->find($this->data['booking_id']);

        if ($booking->user_id !== $userId) {
            return ['success' => false, 'message' => 'Bạn không có quyền đánh giá đơn hàng này.'];
        }
        if ($existingRating) {
            return ['success' => false, 'message' => 'Đánh giá này đã hoàn thành không thể đánh giá!'];
        }
        if ($booking->status !== BookingsStatus::Completed) {
            return ['success' => false, 'message' => 'Vui lòng hoàn thành đơn câu để đánh giá!'];
        }

        DB::beginTransaction();
        try {
            if (array_key_exists('picture', $this->data)) {
                $this->data['picture'] = $this->data['picture'] ? $this->fileService->uploadGallery('images', $this->data['picture'], $this->data['picture']) : null;
            } else {
                $this->data['picture'] = null;
            }

            $rating = $this->repository->create($this->data);
            $userScore = $this->userScoreRepository->findUserID($booking->user_id);

            if ($userScore) {
                $lakeChildId = $booking->lakeChild_id;
                $lakeChild = $this->lakeChildRepository->find($lakeChildId);
                $lakeId = $lakeChild->lake_id;

                $exists = $this->repository->existsByUserIdAndLakeId($userScore->user_id, $lakeId);

                $this->userScoreRepository->incrementTotalScores($userScore->user_id, $lakeChildId);

                if ($exists <= 1) {
                    $this->userScoreRepository->incrementTotalLakes($userScore->user_id);
                }
            }

            DB::commit();
            return ['success' => true, 'rating' => $rating];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to add rating: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Failed to add rating: ' . $e->getMessage()];
        }
    }

    public
    function edit(Request $request)
    {
        $this->data = $request->validated();
        try {
            $this->repository->update($this->data['id'], $this->data);
            // Trả về thông báo thành công hoặc dữ liệu đã cập nhật
            return 1;
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return 0;
        }
    }

    public function delete(Request $request)
    {
        $this->data = $request->validated();
        try {
            $this->repository->delete($this->data['id']);
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
