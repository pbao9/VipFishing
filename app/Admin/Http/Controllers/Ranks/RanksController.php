<?php

namespace App\Admin\Http\Controllers\Ranks;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Ranks\RanksRequest;
use App\Admin\Repositories\Ranks\RanksRepositoryInterface;
use App\Admin\Services\Ranks\RanksServiceInterface;
use App\Admin\DataTables\Ranks\RanksDataTable;
use App\Enums\Ranks\RanksCommissionStatus;

class RanksController extends Controller
{
    public function __construct(
        RanksRepositoryInterface $repository, 
        RanksServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.ranks.index',
            'create' => 'admin.ranks.create',
            'edit' => 'admin.ranks.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.ranks.index',
            'create' => 'admin.ranks.create',
            'edit' => 'admin.ranks.edit',
            'delete' => 'admin.ranks.delete'
        ];
    }
    public function index(RanksDataTable $dataTable){
        return $dataTable->render($this->view['index'],[
            'stauts_comission' => RanksCommissionStatus::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('ranks'), route($this->route['index']))]);
    }

    public function create(){

        return view($this->view['create'],['stauts_comission' => RanksCommissionStatus::asSelectArray()]);
    }

    public function store(RanksRequest $request){

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
                'ranks' => $response,
                'stauts_comission' => RanksCommissionStatus::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('ranks'), route($this->route['index']))->add(__('editRanks'))
            ]
        );

    }
 
    public function update(RanksRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}