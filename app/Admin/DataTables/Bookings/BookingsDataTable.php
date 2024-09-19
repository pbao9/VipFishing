<?php

namespace App\Admin\DataTables\Bookings;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class BookingsDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'bookingsTable';
	
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
        BookingsRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'fishing_date' => 'admin.bookings.datatable.fishing-date',
            'total_price' => 'admin.bookings.datatable.total-price',
			'user_id' => 'admin.bookings.datatable.user',
            'fishingset_id' => 'admin.bookings.datatable.fishingset',
            'lakeChild_id' => 'admin.bookings.datatable.lakechild',
            'status' => 'admin.bookings.datatable.status',
            'action' => 'admin.bookings.datatable.action',
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
        $query = $this->repository->getBy([], ['user.balance', 'lakechild', 'fishingset']);
        return $query;
    }

    

    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('bookings'); // Truyền vào tên bảng trong datatable_columns Config
    }

    
	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'fishing_date' => $this->view['fishing_date'],
            'total_price' => $this->view['total_price'],
            'user_id' => $this->view['user_id'],
            'fishingset_id' => $this->view['fishingset_id'],
            'lakeChild_id' => $this->view['lakeChild_id'],
            'status' => $this->view['status'],
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
        $this->customRawColumns = ['id', 'fishing_date', 'total_price', 'user_id', 'fishingset_id', 'lakeChild_id', 'status', 'action'];
    }
}