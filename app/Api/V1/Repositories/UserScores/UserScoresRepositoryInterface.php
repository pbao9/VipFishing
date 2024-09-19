<?php

namespace App\Api\V1\Repositories\UserScores;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface UserScoresRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function findUserID($user_id);
    public function incrementTotalScores($id, $lakeChildID);
    public function incrementTotalLakes($userScoreId);
}
