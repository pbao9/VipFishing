<?php

namespace App\Admin\DataTables\Withdraws;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Withdraws\WithdrawsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class WithdrawsDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'withdrawsTable';

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
        WithdrawsRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'user_id' => 'admin.withdraws.datatable.user',
            'admin_id' => 'admin.withdraws.datatable.admin',
            'amount' => 'admin.withdraws.datatable.amount',
            'status' => 'admin.withdraws.datatable.status',
            'other_bank' => 'admin.withdraws.datatable.other-bank',
            'bank_id' => 'admin.withdraws.datatable.bank',
            'license' => 'admin.withdraws.datatable.license',
            'action' => 'admin.withdraws.datatable.action',
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
        $query = $this->repository->getBy([], ['user.balance', 'admin', 'bank']);
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
        $this->customColumns = $this->traitGetConfigDatatableColumns('withdraws'); // Truyền vào tên bảng trong datatable_columns Config
    }

    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'user_id' => $this->view['user_id'],
            'admin_id' => $this->view['admin_id'],
            'amount' => $this->view['amount'],
            'status' => $this->view['status'],
            'other_bank' => $this->view['other_bank'],
            'bank_id' => $this->view['bank_id'],
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
        $this->customRawColumns = ['user_id', 'admin_id', 'amount', 'status', 'other_bank', 'bank_id', 'license', 'action'];
    }
}