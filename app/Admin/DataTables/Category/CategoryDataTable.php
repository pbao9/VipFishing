<?php

namespace App\Admin\DataTables\Category;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Traits\GetConfig;

class CategoryDataTable extends BaseDataTable
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
        CategoryRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'action' => 'admin.categories.datatable.action',
            'editlink' => 'admin.categories.datatable.editlink',
            'avatar' => 'admin.categories.datatable.avatar',
            'is_active' => 'admin.categories.datatable.is_active',
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
        // dd($query);
        $this->instanceDataTable = datatables()->collection($query);
        // $this->filterColumnCreatedAt();
        $this->editColumnName();
        $this->editColumnCreatedAt();
        $this->editColumnAvatar();
        $this->editColumnIsActive();
        $this->addColumnAction();
        $this->rawColumnsNew();
        return $this->instanceDataTable;
    }
    
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function query()
    {
        $query = $this->repository->getFlatTree();
        $query = $this->filterIsActive($query);
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $this->instanceHtml = $this->builder()
        ->setTableId('categoryTable')
        ->columns($this->getColumns())
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
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('category');
    }

    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }

    protected function filterIsActive($query){
        $value = request('columns.2.search.value');
        if ($value !== null){
            $query = $query->where('is_active', 0);
        }
        return $query;
    }
    protected function editColumnId(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('id', $this->view['editlink']);
    }
    protected function editColumnName(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('name', $this->view['editlink']);
    }
    protected function editColumnAvatar(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('avatar', $this->view['avatar']);
    }
    protected function editColumnIsActive(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('is_active', $this->view['is_active']);
    }
    protected function editColumnCreatedAt(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('created_at', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }
    protected function addColumnAction(){
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
    protected function rawColumnsNew(){
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['name', 'avatar', 'is_active', 'action']);
    }
    protected function htmlParameters(){

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#categoryTable');

            searchColumsDataTable(this);
        }";

        $this->instanceHtml = $this->instanceHtml
        ->parameters($this->parameters);
    }
}