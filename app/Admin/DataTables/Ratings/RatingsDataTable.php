<?php

namespace App\Admin\DataTables\Ratings;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Ratings\RatingsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class RatingsDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'ratingsTable';

    /**
     * Available button actions. When calling an action, the value will be used
     * as the function name (so it should be available)
     * If you want to add or disable an action, overload and modify this property.
     *
     * @var array
     */
    // protected array $actions = ['pageLength', 'excel', 'reset', 'reload'];
    protected array $actions = ['reset', 'reload'];

    public function __construct(
        RatingsRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.ratings.datatable.id',
            'username' => 'admin.ratings.datatable.username',
            'action' => 'admin.ratings.datatable.action',
            'rate' => 'admin.ratings.datatable.rate',
            'note' => 'admin.ratings.datatable.note',
            'picture' => 'admin.ratings.datatable.picture',
            'booking_id' => 'admin.ratings.datatable.booking',
        ];
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     * Hàm thực thi gọi lệnh truy xuất từ Database ( Repository )
     */
    public function query()
    {
        $query = $this->repository->getBy([], ['booking']);
        return $query;
    }


    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns()
    {
        $this->customColumns = $this->traitGetConfigDatatableColumns('ratings'); // Truyền vào tên bảng trong datatable_columns Config
    }


    protected function setCustomEditColumns()
    {
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'username' => $this->view['username'],
            'rate' => $this->view['rate'],
            'note' => $this->view['note'],
            'picture' => $this->view['picture'],
            'action' => $this->view['action'],
            'booking_id' => $this->view['booking_id'],
        ];
    }

    protected function setCustomAddColumns()
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns()
    {
        $this->customRawColumns = ['id', 'username', 'rate', 'booking_id', 'note', 'picture', 'action'];
    }
}
