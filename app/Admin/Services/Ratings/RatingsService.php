<?php

namespace App\Admin\Services\Ratings;

use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;
use App\Admin\Repositories\LakeChildRatings\LakeChildRatingsRepositoryInterface;
use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Admin\Repositories\Lakes\LakesRepositoryInterface;
use App\Admin\Repositories\UserScores\UserScoresRepositoryInterface;
use App\Admin\Services\Ratings\RatingsServiceInterface;
use  App\Admin\Repositories\Ratings\RatingsRepositoryInterface;
use App\Enums\Bookings\BookingsStatus;
use App\Models\Lakechilds;
use App\Models\Ratings;
use App\Models\Bookings;
use App\Models\UserScores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RatingsService implements RatingsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $bookingRepository;
    protected $lakeChildRepository;
    protected $userScoreRepository;

    protected $lakeRepository;


    public function __construct(
        RatingsRepositoryInterface $repository,
        LakechildsRepositoryInterface $lakeChildRepository,
        BookingsRepositoryInterface $bookingRepository,
        UserScoresRepositoryInterface $userScoreRepository,
        LakesRepositoryInterface $lakeRepository
    ) {
        $this->repository = $repository;
        $this->lakeChildRepository = $lakeChildRepository;
        $this->bookingRepository = $bookingRepository;
        $this->userScoreRepository = $userScoreRepository;
        $this->lakeRepository = $lakeRepository;
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validated();
    //     $booking = $this->bookingRepository->find($data['booking_id']);



    //     if ($this->repository->existsByBookingId($data['booking_id'])) {
    //         return ['error' => __('Bạn đã đánh giá cho đơn đặt câu này rồi.')];
    //     }
    //     if ($booking->status !== BookingsStatus::Completed) {
    //         return ['error' => __('Không thể tạo đánh giá khi đơn đặt câu chưa hoàn thành.')];
    //     }

    //     DB::beginTransaction();
    //     try {
    //         $data['picture'] = $data['picture'] ? explode(",", $data['picture']) : null;
    //         $rating = $this->repository->create($data);


    //         $userScore = $this->userScoreRepository->findUserID($booking->user_id);
    //         if ($userScore) {
    //             $this->userScoreRepository->incrementTotalScores($userScore->id);
    //         }
    //         DB::commit();
    //         return $rating;
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         throw $th;
    //         return false;
    //     }
    // }

    public function store(Request $request)
    {
        $data = $request->validated();
        $booking = $this->bookingRepository->find($data['booking_id']);

        if ($this->repository->existsByBookingId($data['booking_id'])) {
            return ['error' => __('Bạn đã đánh giá cho đơn đặt câu này rồi.')];
        }

        if ($booking->status !== BookingsStatus::Completed) {
            return ['error' => __('Không thể tạo đánh giá khi đơn đặt câu chưa hoàn thành.')];
        }

        DB::beginTransaction();
        try {
            $data['picture'] = $data['picture'] ? explode(",", $data['picture']) : null;
            $rating = $this->repository->create($data);

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
            return $rating;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return false;
        }
    }


    public function update(Request $request)
    {

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function checkBooking($id)
    {
        $rating = $this->repository->findOrFail($id);
        $booking = $rating->booking;
    }

    public function updateRating($id)
    {
        try {
            // Tìm rating theo id
            $rating = $this->repository->findOrFail($id);

            // Lấy user_id từ booking của rating
            $user_id = $rating->booking->user->id;

            // Tìm user scores theo user_id
            $userScores = UserScores::where('user_id', $user_id)->firstOrFail();
            $userScores = $this->userScoreRepository->where('user_id', '=', $user_id)->firstOrFail();
            // Cập nhật total_hcv
            $userScores->total_hcv += 1;

            // Lưu user scores
            $userScores->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to update rating: ' . $e->getMessage());
            return false;
        }
    }
}
