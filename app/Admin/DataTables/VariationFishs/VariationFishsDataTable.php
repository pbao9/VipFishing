<?php

namespace App\Admin\DataTables\VariationFishs;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\VariationFishs\VariationFishsRepositoryInterface;
use App\Admin\Traits\GetConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VariationFishsDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'variationFishsTable';
    protected $fish_id;
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
        VariationFishsRepositoryInterface $repository,
        Request $request
    ){
        parent::__construct();

        $this->repository = $repository;
        $this->fish_id = $request->route('fish_id');
    }

    public function getView(){
        return [
			'density' => 'admin.variationFishs.datatable.density',
			'fish' =>'admin.variationFishs.datatable.fish',
            'action' => 'admin.variationFishs.datatable.action',
            'fish_price' => 'admin.variationFishs.datatable.fish_price',
        ];
    }

    
    
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     * Hàm thực thi gọi lệnh truy xuất từ Database ( Repository )
     */
    public function query(){
        $filter = [];
        if ($this->fish_id) {
            $filter['fish_id'] = $this->fish_id;
        }
        return $this->repository->getBy($filter, ['fish.provinces']);       
    }

    

    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('variationFishs'); // Truyền vào tên bảng trong datatable_columns Config
    }

    
	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'fish_density' => $this->view['density'],
            'fish_id'=> $this->view['fish'],
            'fish_price' => $this->view['fish_price']
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
        $this->customRawColumns = ['fish_density', 'action','fish_id'];
    }
}