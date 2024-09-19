<?php

namespace App\Admin\DataTables\TransactionHistory;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Admin\Traits\GetConfig;

class TransactionHistoryDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'transactionHistoryTable';
	
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
        TransactionHistoryRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'user_id' => 'admin.transactionHistory.datatable.user',
			'transaction_type' => 'admin.transactionHistory.datatable.transaction_type',
            'balance_after' => 'admin.transactionHistory.datatable.balance_after',
            'amount' => 'admin.transactionHistory.datatable.amount',
            'action' => 'admin.transactionHistory.datatable.action',
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
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('transactionHistory'); // Truyền vào tên bảng trong datatable_columns Config
    }

    
	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'user_id' => $this->view['user_id'],
            'transaction_type' => $this->view['transaction_type'],
            'balance_after' => $this->view['balance_after'],
            'amount' => $this->view['amount'],
        ];
    }
	
	// Thiết lập Thêm một cột
    protected function setCustomAddColumns(){
		// Danh sách các mảng view cột sẽ thêm
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }
    
	
	// Thiết lập Cột Nguyên Thủy Không Bị Dính HTML
	// Truyền vào là 1 mảng tên các cột
	protected function setCustomRawColumns(){
        $this->customRawColumns = ['user_id', 'transaction_type', 'balance_after', 'amount', 'action'];
    }
}