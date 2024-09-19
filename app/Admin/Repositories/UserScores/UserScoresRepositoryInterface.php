<?php

namespace App\Admin\Repositories\UserScores;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface UserScoresRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function findUserID($user_id);
    public function incrementTotalScores($id, $lakeChildID);
    public function incrementTotalLakes($userScoreId);
}
