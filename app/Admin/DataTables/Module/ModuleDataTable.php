<?php

namespace App\Admin\DataTables\Module;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Module\ModuleRepositoryInterface;
use App\Admin\Traits\GetConfig;

class ModuleDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'moduleTable';
	
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
        ModuleRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
			'id' => 'admin.module.datatable.cotid',
			'name' => 'admin.module.datatable.name',
			'status' => 'admin.module.datatable.status',
            'action' => 'admin.module.datatable.action',
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
        $query = $this->repository->getAll();
        return $query;
    }

    

    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('module'); // Truyền vào tên bảng trong datatable_columns Config
    }

    
	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'name' => $this->view['name'],
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
        $this->customRawColumns = ['name', 'action', 'status'];
    }
}