<?php

namespace App\Admin\DataTables\Deposits;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Deposits\DepositsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class DepositsDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'depositsTable';

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
        DepositsRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'user_id' => 'admin.deposits.datatable.user',
            'amount' => 'admin.deposits.datatable.amount',
            'status' => 'admin.deposits.datatable.status',
            'type' => 'admin.deposits.datatable.type',
            'license' => 'admin.deposits.datatable.license',
            'action' => 'admin.deposits.datatable.action',
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
        $query = $this->repository->getBy([], ['user.balance']);
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
        $this->customColumns = $this->traitGetConfigDatatableColumns('deposits'); // Truyền vào tên bảng trong datatable_columns Config
    }


    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'user_id' => $this->view['user_id'],
            'amount' => $this->view['amount'],
            'status' => $this->view['status'],
            'type' => $this->view['type'],
            'license' => $this->view['license']
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
        $this->customRawColumns = ['user_id', 'amount', 'status', 'type', 'license', 'action'];
    }
}