<?php

namespace App\Admin\DataTables\Lakes;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Lakes\LakesRepositoryInterface;
use App\Admin\Traits\GetConfig;

class LakesDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'lakesTable';

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
        LakesRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.lakes.datatable.id',
            'name' => 'admin.lakes.datatable.name',
            'phone' => 'admin.lakes.datatable.phone',
            'map' => 'admin.lakes.datatable.map',
            'description' => 'admin.lakes.datatable.description',
            'car_parking' => 'admin.lakes.datatable.car_parking',
            'dinner' => 'admin.lakes.datatable.dinner',
            'lunch' => 'admin.lakes.datatable.lunch',
            'toilet' => 'admin.lakes.datatable.toilet',
            'avatar' => 'admin.lakes.datatable.avatar',
            'slot_lakechild' => 'admin.lakes.datatable.slot_lakechild',
            'status' => 'admin.lakes.datatable.status',
            'province' => 'admin.lakes.datatable.province',
            'point' => 'admin.lakes.datatable.point',
            'action' => 'admin.lakes.datatable.action',
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
        $query = $this->repository->getBy([], ['provinces']);
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
        $this->customColumns = $this->traitGetConfigDatatableColumns('lakes'); // Truyền vào tên bảng trong datatable_columns Config
    }


    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'name' => $this->view['name'],
            'phone' => $this->view['phone'],
            'address' => $this->view['province'],
            'map' => $this->view['map'],
            'description' => $this->view['description'],
            'car_parking' => $this->view['car_parking'],
            'dinner' => $this->view['dinner'],
            'lunch' => $this->view['lunch'],
            'toilet' => $this->view['toilet'],
            'avatar' => $this->view['avatar'],
            'slot_lakechild' => $this->view['slot_lakechild'],
            'point' => $this->view['point'],
            'status' => $this->view['status'],
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
            'phone',
            'address',
            'map',
            'description',
            'car_parking',
            'dinner',
            'lunch',
            'toilet',
            'avatar',
            'slot_lakechild',
            'point',
            'status',
            'action'
        ];
    }
}
