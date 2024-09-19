<?php

namespace App\Admin\DataTables\LakeRatings;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\LakeRatings\LakeRatingsRepositoryInterface;
use App\Admin\Traits\GetConfig;
use Illuminate\Http\Request;

class LakeRatingsDataTable extends BaseDataTable
{

    use GetConfig;

    // ID ( Client ) của bảng DataTable
    protected $nameTable = 'ratingsTable';
    protected $lake_id;

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
        LakeRatingsRepositoryInterface $repository,
        Request                        $request

    ) {
        parent::__construct();
        $this->lake_id = $request->route('lake_id');
        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'id' => 'admin.ratings.datatable.id',
            'username' => 'admin.ratings.datatable.username',
            'action' => 'admin.ratings.datatable.action',
            'rate' => 'admin.ratings.datatable.rate',
            'note' => 'admin.ratings.datatable.note',
            'booking_id' => 'admin.ratings.datatable.booking',
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
        return $this->repository->getQueryBookingLake($this->lake_id);
    }


    /**
     * Get columns.
     *
     * @return array
     * Hàm kết nối tới datatable_columns Config
     */
    protected function setCustomColumns()
    {
        $this->customColumns = $this->traitGetConfigDatatableColumns('lake_ratings'); // Truyền vào tên bảng trong datatable_columns Config
    }


    // Thiết lập Sửa một cột
    protected function setCustomEditColumns()
    {
        // Danh sách các mảng view cột sẽ sửa lại
        $this->customEditColumns = [
            'id' => $this->view['id'],
            'username' => $this->view['username'],
            'rate' => $this->view['rate'],
            'note' => $this->view['note'],
            'action' => $this->view['action'],
            'booking_id' => $this->view['booking_id'],
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
        $this->customRawColumns = ['id', 'username', 'rate', 'booking_id', 'note', 'action'];
    }
}
