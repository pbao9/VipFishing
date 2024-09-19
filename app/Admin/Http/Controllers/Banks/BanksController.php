<?php

namespace App\Admin\Http\Controllers\Banks;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Banks\BanksRequest;
use App\Admin\Repositories\Banks\BanksRepositoryInterface;
use App\Admin\Services\Banks\BanksServiceInterface;
use App\Admin\DataTables\Banks\BanksDataTable;


class BanksController extends Controller
{
    public function __construct(
        BanksRepositoryInterface $repository, 
        BanksServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.banks.index',
            'create' => 'admin.banks.create',
            'edit' => 'admin.banks.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.banks.index',
            'create' => 'admin.banks.create',
            'edit' => 'admin.banks.edit',
            'delete' => 'admin.banks.delete'
        ];
    }
    public function index(BanksDataTable $dataTable){
        return $dataTable->render($this->view['index'],[
            'breadcrumbs' => $this->crums->add(__('Banks'), route($this->route['index']))
        ]);
    }

    public function create(){

        return view($this->view['create'],[
            'breadcrumbs' => $this->crums->add(__('Banks'), route($this->route['index']))->add(__('addBanks'))
        ]);
    }

    public function store(BanksRequest $request){

        $response = $this->service->store($request);
        if($response){
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){
        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'banks' => $response,
                'breadcrumbs' => $this->crums->add(__('Banks'), route($this->route['index']))->add(__('editBanks'))
            ]
        );

    }
 
    public function update(BanksRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}