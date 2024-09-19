<?php

namespace App\Admin\DataTables\Fishs;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Fishs\FishsRepositoryInterface;
use App\Admin\Traits\GetConfig;
use Illuminate\Database\Eloquent\Collection;

class FishsDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'fishsTable';
	
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
        FishsRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
			'name' => 'admin.fishs.datatable.name',
            'province' => 'admin.fishs.datatable.province',
            'variation_link' => 'admin.fishs.datatable.variation_link',
            'action' => 'admin.fishs.datatable.action',
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
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('fishs'); // Truyền vào tên bảng trong datatable_columns Config
    }

    
	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
        // dd($this->query());
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'province_code' => $this->view['province'],
        ];
    }
	
	// Thiết lập Thêm một cột
    protected function setCustomAddColumns(){
		// Danh sách các mảng view cột sẽ thêm
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'variation_link' => $this->view['variation_link'],
        ];
    }
    
	
	// Thiết lập Cột Nguyên Thủy Không Bị Dính HTML
	// Truyền vào là 1 mảng tên các cột
	protected function setCustomRawColumns(){
        $this->customRawColumns = ['name', 'action', 'province_code', 'variation_link'];
    }
}