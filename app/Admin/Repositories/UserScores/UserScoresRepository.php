<?php

namespace App\Admin\Repositories\UserScores;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Admin\Repositories\UserScores\UserScoresRepositoryInterface;
use App\Models\UserScores;
use Illuminate\Support\Facades\Log;

class UserScoresRepository extends EloquentRepository implements UserScoresRepositoryInterface
{

    protected $select = [];
    protected $lakeChildRepository;

    public function __construct(
        LakechildsRepositoryInterface $lakeChildRepository
    ) {
        parent::__construct();
        $this->lakeChildRepository = $lakeChildRepository;
    }


    public function getModel()
    {
        return UserScores::class;
    }

    public function findUserID($user_id)
    {
        return $this->model->where('user_id', $user_id)->first();
    }

    public function incrementTotalScores($id, $lakeChildID)
    {
        $userScore = $this->model->find($id);
        $lakeChild = $this->lakeChildRepository->find($lakeChildID);
        // dd($lakeChildID);
        $ccvPoints = $lakeChild->collect_fish_price / 100000;
        // dd($ccvPoints);
        if ($userScore) {
            $userScore->increment('total_rating');
            $userScore->increment('total_hcv');
            $userScore->increment('total_ccv', $ccvPoints);
            $userScore->increment('total_round');
        }
        return $userScore;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function incrementTotalLakes($user_id)
    {
        $userScore = $this->model->find($user_id);
        if ($userScore) {
            $userScore->total_lake += 1;
            $userScore->save();
        }
    }
}
