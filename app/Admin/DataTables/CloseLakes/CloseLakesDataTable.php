<?php

namespace App\Admin\DataTables\CloseLakes;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\CloseLakes\CloseLakesRepositoryInterface;
use App\Admin\Traits\GetConfig;

class CloseLakesDataTable extends BaseDataTable
{

    use GetConfig;

	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'closeLakesTable';

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
        CloseLakesRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
			'id' => 'admin.closeLakes.datatable.id',
            'lakechild_id' => 'admin.closeLakes.datatable.lakechild',
            'close_date' => 'admin.closeLakes.datatable.close-date',
            'open_date' => 'admin.closeLakes.datatable.open-date',
            'total_refund_amount' => 'admin.closeLakes.datatable.total-refund-amount',
            'compensation_amount' => 'admin.closeLakes.datatable.compensation-amount',
            'action' => 'admin.closeLakes.datatable.action',
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
        $query = $this->repository->getBy([], ['lakechild']);
        return $query;
    }



    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('closeLakes'); // Truyền vào tên bảng trong datatable_columns Config
    }


	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'lakechild_id' => $this->view['lakechild_id'],
            'close_date' => $this->view['close_date'],
            'open_date' => $this->view['open_date'],
            'total_refund_amount' => $this->view['total_refund_amount'],
            'compensation_amount' => $this->view['compensation_amount'],
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
        $this->customRawColumns = ['id', 'lakechild_id', 'close_date', 'open_date', 'total_refund_amount', 'compensation_amount', 'action'];
    }
}
