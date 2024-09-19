<?php

namespace App\Admin\DataTables\LakeFishs;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\LakeFishs\LakeFishsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class LakeFishsDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'lakeFishsTable';
	
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
        LakeFishsRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
			'fish' => 'admin.lakeFishs.datatable.fish',
            'lakechild' => 'admin.lakeFishs.datatable.lakechild',
            'action' => 'admin.lakeFishs.datatable.action',
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
        $data = $this->repository->getBy([], ['fish','lake_child']);
        return $data;
    }

    

    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('lakeFishs'); // Truyền vào tên bảng trong datatable_columns Config
    }

    
	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'lakechild_id' => $this->view['lakechild'],
            'fish_id' => $this->view['fish'],
        ];
    }
	
	// Thiết lập Thêm một cột
    protected function setCustomAddColumns(){
		// Danh sách các mảng view cột sẽ thêm
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'lakechild_id' => $this->view['lakechild'],
            'fish_id' => $this->view['fish'],
        ];
    }
    
	
	// Thiết lập Cột Nguyên Thủy Không Bị Dính HTML
	// Truyền vào là 1 mảng tên các cột
	protected function setCustomRawColumns(){
        $this->customRawColumns = ['lakechild_id','fish_id', 'action'];
    }
}