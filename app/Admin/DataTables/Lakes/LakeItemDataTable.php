<?php

namespace App\Admin\DataTables\Lakechilds;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class LakechildsDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'lakechildsTable';

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
        LakechildsRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.lakechilds.datatable.id',
            'name' => 'admin.lakechilds.datatable.name',
            'description' => 'admin.lakechilds.datatable.description',
            'area' => 'admin.lakechilds.datatable.area',
            'day_set' => 'admin.lakechilds.datatable.day_set',
            'morning_set' => 'admin.lakechilds.datatable.morning_set',
            'afternoon_set' => 'admin.lakechilds.datatable.afternoon_set',
            'fish_volume' => 'admin.lakechilds.datatable.fish_volume',
            'fish_density' => 'admin.lakechilds.datatable.fish_density',
            'fish_rod_limit' => 'admin.lakechilds.datatable.fish_rod_limit',
            'open_time' => 'admin.lakechilds.datatable.open_time',
            'close_time' => 'admin.lakechilds.datatable.close_time',
            'open_day' => 'admin.lakechilds.datatable.open_day',
            'status' => 'admin.lakechilds.datatable.status',
            'compensation' => 'admin.lakechilds.datatable.compensation',
            'collect_fish_price' => 'admin.lakechilds.datatable.collect_fish_price',
            'collect_fish_type' => 'admin.lakechilds.datatable.collect_fish_type',
            'commission_rate' => 'admin.lakechilds.datatable.commission_rate',
            'type' => 'admin.lakechilds.datatable.type',
            'lake_id' => 'admin.lakechilds.datatable.lake_id',
            'fish_id' => 'admin.lakechilds.datatable.fish_id',
            'action' => 'admin.lakechilds.datatable.action',
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
        $query = $this->repository->getBy([], ['fish', 'lake']);
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
        $this->customColumns = $this->traitGetConfigDatatableColumns('lakechilds'); // Truyền vào tên bảng trong datatable_columns Config
    }


    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'name' => $this->view['name'],
            'description' => $this->view['description'],
            'area' => $this->view['area'],
            'day_set' => $this->view['day_set'],
            'morning_set' => $this->view['morning_set'],
            'afternoon_set' => $this->view['afternoon_set'],
            'fish_volume' => $this->view['fish_volume'],
            'fish_density' => $this->view['fish_density'],
            'fish_rod_limit' => $this->view['fish_rod_limit'],
            'open_time' => $this->view['open_time'],
            'close_time' => $this->view['close_time'],
            'open_day' => $this->view['open_day'],
            'status' => $this->view['status'],
            'compensation' => $this->view['compensation'],
            'collect_fish_price' => $this->view['collect_fish_price'],
            'collect_fish_type' => $this->view['collect_fish_type'],
            'commission_rate' => $this->view['commission_rate'],
            'type' => $this->view['type'],
            'lake_id' => $this->view['lake_id'],
            'fish_id' => $this->view['fish_id'],
            'action' => $this->view['action'],
        ];
    }

    // Thiết lập Thêm một cột
    protected function setCustomAddColumns()
    {
        // Danh sách các mảng view cột sẽ thêm
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }


    // Thiết lập Cột Nguyên Thủy Không Bị Dính HTML
    // Truyền vào là 1 mảng tên các cột
    protected function setCustomRawColumns()
    {
        $this->customRawColumns = [
            'id',
            'name',
            'description',
            'area',
            'day_set',
            'morning_set',
            'afternoon_set',
            'fish_volume',
            'fish_density',
            'fish_rod_limit',
            'open_time',
            'close_time',
            'open_day',
            'status',
            'compensation',
            'collect_fish_price',
            'collect_fish_type',
            'commission_rate',
            'type',
            'lake_id',
            'fish_id',
            'action'
        ];
    }
}
