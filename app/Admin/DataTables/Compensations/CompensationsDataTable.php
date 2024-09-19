<?php

namespace App\Admin\DataTables\Compensations;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Compensations\CompensationsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class CompensationsDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'compensationsTable';
	
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
        CompensationsRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
			'amount' => 'admin.compensations.datatable.amount',
            'user_id' => 'admin.compensations.datatable.user',
            'booking_id' => 'admin.compensations.datatable.booking',
            'action' => 'admin.compensations.datatable.action',
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
        $query = $this->repository->getBy([], ['user.balance', 'booking.lakechild']);
        return $query;
    }

    

    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('compensations'); // Truyền vào tên bảng trong datatable_columns Config
    }

    
	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'amount' => $this->view['amount'],
            'user_id' => $this->view['user_id'],
            'booking_id' => $this->view['booking_id'],
            'action' => $this->view['action'],

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
        $this->customRawColumns = ['amount', 'user_id', 'booking_id', 'action'];
    }
}