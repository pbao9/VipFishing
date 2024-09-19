<?php

namespace App\Admin\DataTables\Product;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Traits\GetConfig;

class ProductDataTable extends BaseDataTable
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
        ProductRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'action' => 'admin.products.datatable.action',
            'editlink' => 'admin.products.datatable.editlink',
            'avatar' => 'admin.products.datatable.avatar',
            'instock' => 'admin.products.datatable.instock',
            'is_user_discount' => 'admin.products.datatable.is-user-discount',
            'price' => 'admin.products.datatable.price',
            'categories' => 'admin.products.datatable.categories'
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
        $this->instanceDataTable = datatables()->eloquent($query)->addIndexColumn();
        $this->filterColumnCreatedAt();
        $this->filterColumnCategories();
        $this->editColumnAvatar();
        $this->editColumnName();
        $this->editColumnInStock();
        $this->editColumnIsUserDiscount();
        $this->editColumnPrice();
        $this->editColumnCategoreis();
        $this->editColumnCreatedAt();
        $this->addColumnAction();
        $this->rawColumnsNew();
        return $this->instanceDataTable;
    }
    
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
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
        ->setTableId('productTable')
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
        $this->customColumns = $this->traitGetConfigDatatableColumns('product');
    }

    protected function filename(): string
    {
        return 'products_' . date('YmdHis');
    }

    protected function filterColumnCreatedAt(){
        $this->instanceDataTable = $this->instanceDataTable->filterColumn('created_at', function($query, $keyword) {
            
            $query->whereDate('created_at', date('Y-m-d', strtotime($keyword)));

        });
    }
    protected function filterColumnCategories(){
        $this->instanceDataTable = $this->instanceDataTable->filterColumn('categories', function($query, $keyword) {
            $keyword = explode(',', $keyword);
            $query->whereHas('categories', function($query) use ($keyword){
                $query->whereIn('id', $keyword);
            });

        });
    }
    protected function editColumnId(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('id', $this->view['editlink']);
    }
    protected function editColumnAvatar(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('avatar', $this->view['avatar']);
    }
    protected function editColumnName(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('name', $this->view['editlink']);
    }
    protected function editColumnInStock(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('in_stock', $this->view['instock']);
    }
    protected function editColumnIsUserDiscount(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('is_user_discount', $this->view['is_user_discount']);
    }
    protected function editColumnPrice(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('price', $this->view['price']);
    }
    protected function editColumnCategoreis(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('categories', $this->view['categories']);
    }
    protected function editColumnCreatedAt(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('created_at', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }
    protected function addColumnAction(){
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
    protected function rawColumnsNew(){
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['avatar', 'name', 'in_stock', 'is_user_discount', 'categories', 'price', 'action']);
    }
    protected function htmlParameters(){

        $this->parameters['buttons'] = $this->actions;

        $this->parameters['initComplete'] = "function () {

            moveSearchColumnsDatatable('#productTable');

            searchColumsDataTable(this);
        
            addSelect2();
        }";

        $this->instanceHtml = $this->instanceHtml
        ->parameters($this->parameters);
    }
}