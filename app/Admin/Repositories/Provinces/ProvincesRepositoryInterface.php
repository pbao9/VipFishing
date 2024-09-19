<?php
    namespace App\Admin\Repositories\Provinces;

    use App\Admin\Repositories\EloquentRepositoryInterface;

    interface ProvincesRepositoryInterface extends EloquentRepositoryInterface
    {
        public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
        public function getAllProvinces();
}
?>