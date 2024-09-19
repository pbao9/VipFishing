<?php

namespace App\Admin\DataTables\Lakechilds;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Admin\Traits\GetConfig;
use Illuminate\Http\Request;

class LakechildsDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'lakechildsTable';
    protected $lake_id;
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
        LakechildsRepositoryInterface $repository,
        Request                       $request

    ) {
        parent::__construct();

        $this->repository = $repository;
        $this->lake_id = $request->route('lake_id');
    }

    public function getView()
    {
        return [
            'id' => 'admin.lakes.items.datatable.id',
            'name' => 'admin.lakes.items.datatable.name',
            'description' => 'admin.lakes.items.datatable.description',
            'area' => 'admin.lakes.items.datatable.area',
            'fish_volume' => 'admin.lakes.items.datatable.fish_volume',
            'fish_density' => 'admin.lakes.items.datatable.fish_density',
            'fish_rod_limit' => 'admin.lakes.items.datatable.fish_rod_limit',
            'open_time' => 'admin.lakes.items.datatable.open_time',
            'close_time' => 'admin.lakes.items.datatable.close_time',
            'open_day' => 'admin.lakes.items.datatable.open_day',
            'status' => 'admin.lakes.items.datatable.status',
            'compensation' => 'admin.lakes.items.datatable.compensation',
            'collect_fish_price' => 'admin.lakes.items.datatable.collect_fish_price',
            'collect_fish_type' => 'admin.lakes.items.datatable.collect_fish_type',
            'type' => 'admin.lakes.items.datatable.type',
            'lake_id' => 'admin.lakes.items.datatable.lake_id',
            'fish_id' => 'admin.lakes.items.datatable.fish_id',
            'action' => 'admin.lakes.items.datatable.action',
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
        $filter = [];
        if ($this->lake_id) {
            $filter['lake_id'] = $this->lake_id;
        }
        return $this->repository->getBy($filter, ['fish.provinces', 'lake']);
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
            'type',
            'lake_id',
            'fish_id',
            'action'
        ];
    }
}
