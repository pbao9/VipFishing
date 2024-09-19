<?php

namespace App\Admin\DataTables\Slider;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Slider\SliderItemRepositoryInterface;
use App\Admin\Traits\GetConfig;

class SliderItemDataTable extends BaseDataTable
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
        SliderItemRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'action' => 'admin.sliders.items.datatable.action',
            'editlink' => 'admin.sliders.items.datatable.editlink',
            'image' => 'admin.sliders.items.datatable.image',
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
        $this->editColumnTitle();
        $this->editColumnImage();
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
        return $this->repository->getQueryBuilderByColumns('slider_id', $this->slider->id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $this->instanceHtml = $this->builder()
        ->setTableId('sliderItemTable')
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
        $this->customColumns = $this->traitGetConfigDatatableColumns('slider_item');
    }

    protected function filename(): string
    {
        return 'sliderItem_' . date('YmdHis');
    }

    protected function editColumnTitle(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('title', $this->view['editlink']);
    }
    protected function editColumnImage(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('image', $this->view['image']);
    }
    protected function editColumnCreatedAt(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('created_at', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }
    protected function addColumnAction(){
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
    protected function rawColumnsNew(){
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['title', 'image', 'action']);
    }
    protected function htmlParameters(){

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#sliderItemTable');

            searchColumsDataTable(this);
        }";

        $this->instanceHtml = $this->instanceHtml
        ->parameters($this->parameters);
    }
}