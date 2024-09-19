<?php

namespace App\Admin\DataTables\User;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Traits\GetConfig;

class UserDataTable extends BaseDataTable
{

    use GetConfig;
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
        UserRepositoryInterface $repository
    ) {
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'action' => 'admin.users.datatable.action',
            'editlink' => 'admin.users.datatable.editlink',
            'bank_id' => 'admin.users.datatable.bank',
            'rank_id' => 'admin.users.datatable.rank',
            'balance' => 'admin.users.datatable.balance'
        ];
    }
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->instanceDataTable = datatables()->eloquent($query);
        // ->addIndexColumn();
        $this->filterColumnCreatedAt();
        $this->filterColumnGender();
        $this->filterColumnRank();
        $this->filterColumnBank();
        $this->editColumnFullname();
        $this->editColumnGender();
        $this->editColumnBank();
        $this->editColumnRank();
        $this->editColumnBalance();
        $this->editColumnCreatedAt();
        $this->addColumnAction();
        $this->rawColumnsNew();
        return $this->instanceDataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getQueryBuilderWithRelations();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $this->instanceHtml = $this->builder()
            ->setTableId('userTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle();

        $this->htmlParameters();

        return $this->instanceHtml;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function setCustomColumns()
    {
        $this->customColumns = $this->traitGetConfigDatatableColumns('user');
    }

    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }

    protected function filterColumnRank()
    {
        $this->instanceDataTable = $this->instanceDataTable
            ->filterColumn('rank_id', function ($query, $keyword) {
                $query->whereHas('rank', function ($query) use ($keyword) {
                    return $query->where('title', 'LIKE', '%' . $keyword . '%');
                });
            });
    }
    protected function filterColumnBank()
    {
        $this->instanceDataTable = $this->instanceDataTable
            ->filterColumn('bank_id', function ($query, $keyword) {
                $query->whereHas('bank', function ($query) use ($keyword) {
                    return $query->where('name', 'LIKE', '%' . $keyword . '%');
                });
            });
    }
    protected function filterColumnGender()
    {
        $this->instanceDataTable = $this->instanceDataTable
            ->filterColumn('gender', function ($query, $keyword) {
                $query->where('gender', $keyword);
            });
    }
    protected function filterColumnCreatedAt()
    {
        $this->instanceDataTable = $this->instanceDataTable->filterColumn('created_at', function ($query, $keyword) {

            $query->whereDate('created_at', date('Y-m-d', strtotime($keyword)));
        });
    }
    protected function editColumnId()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('id', $this->view['editlink']);
    }
    protected function editColumnFullname()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('fullname', $this->view['editlink']);
    }
    protected function editColumnGender()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('gender', function ($admin) {
            return $admin->gender->description;
        });
    }
    protected function editColumnBank()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('bank_id', $this->view['bank_id']);
    }
    protected function editColumnRank()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('rank_id', $this->view['rank_id']);
    }

    protected function editColumnBalance()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('balance', $this->view['balance']);
    }

    protected function editColumnCreatedAt()
    {
        $this->instanceDataTable = $this->instanceDataTable->editColumn('created_at', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }
    protected function addColumnAction()
    {
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
    protected function rawColumnsNew()
    {
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['fullname', 'bank_id', 'rank_id', 'action']);
    }
    protected function htmlParameters()
    {

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#userTable');

            searchColumsDataTable(this);
        }";

        $this->instanceHtml = $this->instanceHtml
            ->parameters($this->parameters);
    }
}
