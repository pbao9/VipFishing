<?php
    namespace App\Admin\Repositories\Provinces;
    use App\Admin\Repositories\EloquentRepository;
    use App\Admin\Repositories\Provinces\ProvincesRepositoryInterface;
    use App\Models\Province;

    class ProvincesRepository extends EloquentRepository implements ProvincesRepositoryInterface{
        protected $select = [];

        public function getModel(){
            return Province::class;
        }

        public function getAllProvinces(){
            return $this->model->all();
        }

        public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
            $this->getQueryBuilder();
            $this->instance = $this->instance->orderBy($column, $sort);
            return $this->instance;
        }

        protected function getQueryBuilderFindByKey($key){
            $this->instance = $this->instance->where(function($query) use ($key){
                return $query->where('name', 'LIKE', '%'.$key.'%')
                ->orWhere('id', 'LIKE', '%'.$key.'%');
            });
        }

        public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'name'], $limit = 10){
            $this->instance = $this->model->select($select);
            $this->getQueryBuilderFindByKey($keySearch);

            foreach($meta as $key => $value){
                $this->instance = $this->instance->where($key, $value);
            }

            return $this->instance->limit($limit)->get();
        }


    }
?>
