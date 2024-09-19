<?php

namespace App\Admin\DataTables\Admin;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Admin\Traits\GetConfig;

class AdminDataTable extends BaseDataTable
{

    use GetConfig;
	
	// ID ( Client ) của bảng DataTable
	protected $nameTable = 'adminTable';
    /**
     * Available button actions. When calling an action, the value will be used
     * as the function name (so it should be available)
     * If you want to add or disable an action, overload and modify this property.
     *
     * @var array
     */
    protected array $actions = ['reset', 'reload'];

    public function __construct(
        AdminRepositoryInterface $repository
    ){
        parent::__construct();

        $this->repository = $repository;
    }

    public function getView(){
        return [
            'action' => 'admin.admins.datatable.action',
            'roles' => 'admin.admins.datatable.roles',
            'editlink' => 'admin.admins.datatable.editlink',
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
        $this->editColumnFullname();
        $this->editColumnCreatedAt();
        $this->addColumnAction();
        $this->addColumnRoles();
        $this->rawColumnsNew();
        return $this->instanceDataTable;
    }
    
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }



    /**
     * Get columns.
     *
     * @return array
     */
    protected function setCustomColumns(){
        $this->customColumns = $this->traitGetConfigDatatableColumns('admin');
    }




    protected function filterColumnCreatedAt(){
        $this->instanceDataTable = $this->instanceDataTable->filterColumn('created_at', function($query, $keyword) {

            $query->whereDate('created_at', date('Y-m-d', strtotime($keyword)));

        });
    }
    protected function editColumnId(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('id', $this->view['editlink']);
    }
    protected function editColumnFullname(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('fullname', $this->view['editlink']);
    }

    protected function editColumnCreatedAt(){
        $this->instanceDataTable = $this->instanceDataTable->editColumn('created_at', '{{ date("d-m-Y", strtotime($created_at)) }}');
    }
    protected function addColumnAction(){
        $this->instanceDataTable = $this->instanceDataTable->addColumn('action', $this->view['action']);
    }
	
	protected function addColumnRoles(){
		//$this->instanceDataTable = $this->instanceDataTable->addColumn('roles', $this->view['roles']);
        $this->instanceDataTable = $this->instanceDataTable->addColumn('roles', function($queryFromDataTable) {
			$all_roles = '';
			foreach($queryFromDataTable->roles as $role) {
				if($role != null) $all_roles .= '<div class="adminRoleBox"><a target="_blank" href="../admin/role/sua/1">'.$role->title.'</a></div>';
			}
			return $all_roles;
		});
    }
	
    protected function rawColumnsNew(){
        $this->instanceDataTable = $this->instanceDataTable->rawColumns(['fullname', 'action','roles']);
    }

}