<?php

namespace App\Admin\Repositories\Lakechilds;

use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\Lakechilds;

interface LakechildsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function getAllLake();

    public function attachFishingSets(lakeChilds $lakechild, array $fishingSetsId);

    public function syncFishingSets(lakeChilds $lakechild, array $fishingSetsId);

    public function getAllFishingSets();

    public function findOrFailWithRelations($id, $relations = ['lake', 'fishingSet']);
    public function getTotalRateValue($lakeChildId);
}
