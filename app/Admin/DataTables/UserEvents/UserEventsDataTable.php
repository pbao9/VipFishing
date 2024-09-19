<?php

namespace App\Admin\DataTables\UserEvents;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\UserEvents\UserEventsRepositoryInterface;
use App\Admin\Traits\GetConfig;
use Illuminate\Http\Request;

class UserEventsDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'userEventsTable';
    protected $eventId;
	
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
        UserEventsRepositoryInterface $repository,
        Request $request
    ){
        parent::__construct();

        $this->repository = $repository;
        $this->eventId = $request->route('event_id');
    }

    public function getView(){
        return [
            'event_id' => 'admin.userEvents.datatable.event',
            'user_id' => 'admin.userEvents.datatable.user',
            'has_reward' => 'admin.userEvents.datatable.has-reward'
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
        $filter = [];
        if ($this->eventId) {
            $filter['event_id'] = $this->eventId;
        }
        return $this->repository->getBy($filter, ['user', 'event']);
    }

    

    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('userEvents'); // Truyền vào tên bảng trong datatable_columns Config
    }

    
	// Thiết lập Sửa một cột
	protected function setCustomEditColumns(){
		// Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'event_id' => $this->view['event_id'],
            'user_id' => $this->view['user_id'],
            'has_reward' => $this->view['has_reward'],
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
        $this->customRawColumns = ['event_id', 'user_id', 'has_reward'];
    }
}