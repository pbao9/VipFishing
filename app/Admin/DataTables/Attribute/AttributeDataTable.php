<?php

namespace App\Admin\DataTables\Attribute;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Traits\GetConfig;

class AttributeDataTable extends BaseDataTable
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
        AttributeRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'action' => 'admin.attributes.datatable.action',
            'editlink' => 'admin.attributes.datatable.editlink',
            'variations' => 'admin.attributes.datatable.variations',
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
        $this->filterColumnType();
        $this->editColumnName();
        $this->editColumnVariations();
        $this->editColumnType();
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
        ->setTableId('attributeTable')
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
        $this->customColumns = $this->traitGetConfigDatatableColumns('attribute');
    }

    protected function filename(): string
    {
        return 'attribute_' . date('YmdHis');
    }

    protected function filterColumnType(){
        $this->instanceDataTable = $this->instanceDataTable
        ->filterColumn('type', function($query, $keyword) {
            $query->where('type', $keyword);
        });
    }

    protected function editColumnName(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('name', $this->view['editlink']);
    }
    protected function editColumnType(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('type', function($attribute){
            return $attribute->type->description;
        });
    }
    protected function editColumnVariations(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('variations', $this->view['variations']);
    }
    protected function addColumnAction(){
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
    protected function rawColumnsNew(){
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['name', 'variations', 'action']);
    }
    protected function htmlParameters(){

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#attributeTable');

            searchColumsDataTable(this);
        }";

        $this->instanceHtml = $this->instanceHtml
        ->parameters($this->parameters);
    }
}