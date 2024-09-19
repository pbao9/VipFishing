<?php

namespace App\Admin\DataTables\Events;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Events\EventsRepositoryInterface;
use App\Admin\Traits\GetConfig;

class EventsDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'eventsTable';

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
        EventsRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'title' => 'admin.events.datatable.title',
            'picture' => 'admin.events.datatable.picture',
            'reward_value' => 'admin.events.datatable.reward_value',
            'start_date' => 'admin.events.datatable.start_date',
            'end_date' => 'admin.events.datatable.end_date',
            'events_condition' => 'admin.events.datatable.events_condition',
            'status' => 'admin.events.datatable.status',
            'rank_id' => 'admin.events.datatable.rank',
            'user_id' => 'admin.events.datatable.user',
            'lakechild_id' => 'admin.events.datatable.lakechild',
            'userEvent_link' => 'admin.events.datatable.userEvent_link',
            'action' => 'admin.events.datatable.action',
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
        $query = $this->repository->getBy([], ['user.balance', 'rank', 'lakechild']);
        return $query;
    }



    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns()
    {
        $this->customColumns = $this->traitGetConfigDatatableColumns('events'); // Truyền vào tên bảng trong datatable_columns Config
    }


    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'title' => $this->view['title'],
            'picture' => $this->view['picture'],
            'reward_value' => $this->view['reward_value'],
            'start_date' => $this->view['start_date'],
            'end_date' => $this->view['end_date'],
            'events_condition' => $this->view['events_condition'],
            'status' => $this->view['status'],
            'rank_id' => $this->view['rank_id'],
            'user_id' => $this->view['user_id'],
            'lakechild_id' => $this->view['lakechild_id'],
            'userEvent_link' => $this->view['userEvent_link'],
        ];
    }

    // Thiết lập Thêm một cột
    protected function setCustomAddColumns()
    {
        // Danh sách các mảng view cột sẽ thêm
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }


    // Thiết lập Cột Nguyên Thủy Không Bị Dính HTML
    // Truyền vào là 1 mảng tên các cột
    protected function setCustomRawColumns()
    {
        $this->customRawColumns = ['title', 'picture', 'reward_value', 'start_date', 'end_date', 'events_condition', 'status', 'rank_id', 'user_id', 'lakechild_id', 'userEvent_link', 'action'];
    }
}