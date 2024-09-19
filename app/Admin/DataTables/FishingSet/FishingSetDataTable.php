<?php

namespace App\Admin\DataTables\FishingSet;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\FishingSet\FishingSetRepositoryInterface;
use App\Admin\Traits\GetConfig;

class FishingSetDataTable extends BaseDataTable
{

    use GetConfig;

	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'fishingSetTable';

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
        FishingSetRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
			'id' => 'admin.fishingSet.datatable.id',
			'title' => 'admin.fishingSet.datatable.title',
            'time_start' => 'admin.fishingSet.datatable.time_start',
            'time_end' => 'admin.fishingSet.datatable.time_end',
            'time_checkin' => 'admin.fishingSet.datatable.time_checkin',
            'duration' => 'admin.fishingSet.datatable.duration',
            'action' => 'admin.fishingSet.datatable.action',
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
        $this->customColumns = $this->traitGetConfigDatatableColumns('fishingSet'); // Truyền vào tên bảng trong datatable_columns Config
    }


	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'title' => $this->view['title'],
            'time_start' => $this->view['time_start'],
            'time_end' => $this->view['time_end'],
            'time_checkin' => $this->view['time_checkin'],
            'duration' => $this->view['duration'],
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
        $this->customRawColumns = ['id', 'title', 'time_start', 'time_end', "time_checkin", 'duration', 'action'];
    }
}
