<?php

namespace App\Admin\DataTables\BookingLake;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\BookingLake\BookingLakeRepositoryInterface;
use App\Admin\Traits\GetConfig;

class BookingLakeDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'bookingLakeTable';
	
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
        BookingLakeRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'booking_id' => 'admin.bookingLake.datatable.booking',
            'variationFishs_id' => 'admin.bookingLake.datatable.variationfish',
			'total_price' => 'admin.bookingLake.datatable.total-price',
        ];
    }



    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->instanceDataTable = datatables()->collection($query);
        $this->customEditColumns();
        $this->customAddColumns();
		$this->customRawColumns();
        return $this->instanceDataTable;
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
        $query = $this->repository->getBy([], ['booking.lakechild', 'variationfish.fish']);
        return $query;
    }

    

    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('bookingLake'); // Truyền vào tên bảng trong datatable_columns Config
    }

    
	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'booking_id' => $this->view['booking_id'],
            'variationFishs_id' => $this->view['variationFishs_id'],
            'total_price' => $this->view['total_price'],
        ];
    }
	
	// Thiết lập Thêm một cột
    protected function setCustomAddColumns(){
		// Danh sách các mảng view cột sẽ thêm
        $this->customAddColumns = [
        ];
    }
    
	
	// Thiết lập Cột Nguyên Thủy Không Bị Dính HTML
	// Truyền vào là 1 mảng tên các cột
	protected function setCustomRawColumns(){
        $this->customRawColumns = [
            'booking_id',
            'variationFishs_id',
            'total_price', 
        ];
    }
}