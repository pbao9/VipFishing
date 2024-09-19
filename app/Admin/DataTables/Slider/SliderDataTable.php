<?php

namespace App\Admin\DataTables\Slider;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Slider\SliderRepositoryInterface;
use App\Admin\Traits\GetConfig;

class SliderDataTable extends BaseDataTable
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
        SliderRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'action' => 'admin.sliders.datatable.action',
            'editlink' => 'admin.sliders.datatable.editlink',
            'status' => 'admin.sliders.datatable.status',
            'items' => 'admin.sliders.datatable.items',
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
        $this->editColumnName();
        $this->editColumnStatus();
        $this->editColumnItems();
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
        ->setTableId('sliderTable')
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
        $this->customColumns = $this->traitGetConfigDatatableColumns('slider');
    }

    protected function filename(): string
    {
        return 'slider_' . date('YmdHis');
    }

    protected function editColumnName(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('name', $this->view['editlink']);
    }
    protected function editColumnStatus(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('status', $this->view['status']);
    }
    protected function editColumnItems(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('items', $this->view['items']);
    }
    protected function editColumnCreatedAt(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('created_at', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }
    protected function addColumnAction(){
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
    protected function rawColumnsNew(){
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['name', 'status', 'items', 'action']);
    }
    protected function htmlParameters(){

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#sliderTable');

            searchColumsDataTable(this);
        }";

        $this->instanceHtml = $this->instanceHtml
        ->parameters($this->parameters);
    }
}