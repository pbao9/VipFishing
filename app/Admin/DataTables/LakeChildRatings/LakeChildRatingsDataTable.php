<?php

namespace App\Admin\DataTables\LakeChildRatings;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;
use App\Admin\Repositories\LakeChildRatings\LakeChildRatingsRepositoryInterface;
use App\Admin\Traits\GetConfig;
use App\Models\Bookings;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LakeChildRatingsDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'ratingsTable';
    protected $lakechild_id;

    /**
     * Available button actions. When calling an action, the value will be used
     * as the function name (so it should be available)
     * If you want to add or disable an action, overload and modify this property.
     *
     * @var array
     */
    // protected array $actions = ['pageLength', 'excel', 'reset', 'reload'];
    protected array $actions = ['reset', 'reload'];
    protected $bookingsRepository;
    public function __construct(
        LakeChildRatingsRepositoryInterface $repository,
        BookingsRepositoryInterface $bookingsRepository,
        Request                             $request

    ) {
        parent::__construct();
        $this->lakechild_id = $request->route('lakechild_id');
        $this->repository = $repository;
        $this->bookingsRepository = $bookingsRepository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.lakeChildRatings.datatable.id',
            'username' => 'admin.lakeChildRatings.datatable.username',
            'action' => 'admin.lakeChildRatings.datatable.action',
            'booking_id' => 'admin.lakeChildRatings.datatable.booking',
            'feedback' => 'admin.lakeChildRatings.datatable.feedback',
            'status' => 'admin.lakeChildRatings.datatable.status',
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
        return $this->repository->getQueryBookingLakeChild($this->lakechild_id);
    }

    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns()
    {
        $this->customColumns = $this->traitGetConfigDatatableColumns('lake_child_ratings'); // Truyền vào tên bảng trong datatable_columns Config
    }


    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'username' => $this->view['username'],
            'action' => $this->view['action'],
            'booking_id' => $this->view['booking_id'],
            'feedback' => $this->view['feedback'],
            'status' => $this->view['status'],
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
        $this->customRawColumns = ['id', 'username', 'booking_id', 'feedback', 'status', 'action'];
    }
}
