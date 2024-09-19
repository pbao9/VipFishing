<?php

namespace App\Admin\DataTables\PostCategory;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface;
use App\Admin\Traits\GetConfig;

class PostCategoryDataTable extends BaseDataTable
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
        PostCategoryRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'action' => 'admin.posts_categories.datatable.action',
            'editlink' => 'admin.posts_categories.datatable.editlink',
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
        $this->instanceDataTable = datatables()->collection($query);
        $this->editColumnName();
        $this->editColumnStatus();
        $this->editColumnCreatedAt();
        $this->addColumnAction();
        $this->rawColumnsNew();
        return $this->instanceDataTable;
    }
    
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PostCategory $model
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function query()
    {
        $query = $this->repository->getFlatTree();
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
        ->setTableId('postCategoryTable')
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
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('post_category');
    }

    protected function filename(): string
    {
        return 'post_category_' . date('YmdHis');
    }

    
    protected function editColumnName(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('name', $this->view['editlink']);
    }
    protected function editColumnStatus(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('status', function($admin){
            return $admin->status->description;
        });
    }
    protected function editColumnCreatedAt(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('created_at', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }
    protected function addColumnAction(){
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
    protected function rawColumnsNew(){
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['name', 'action']);
    }
    protected function htmlParameters(){

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#postCategoryTable');

            searchColumsDataTable(this);
        }";

        $this->instanceHtml = $this->instanceHtml
        ->parameters($this->parameters);
    }
}