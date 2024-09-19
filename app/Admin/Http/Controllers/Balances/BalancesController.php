<?php

namespace App\Admin\Http\Controllers\Balances;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Balances\BalancesRepositoryInterface;
use App\Admin\Services\Balances\BalancesServiceInterface;
use App\Admin\DataTables\Balances\BalancesDataTable;


class BalancesController extends Controller
{
    public function __construct(
        BalancesRepositoryInterface $repository,
        BalancesServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;


        $this->service = $service;

    }

    public function getView()
    {
        return [
            'index' => 'admin.balances.index',
            // 'create' => 'admin.balances.create',
            // 'edit' => 'admin.balances.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.balances.index',
            // 'create' => 'admin.balances.create',
            // 'edit' => 'admin.balances.edit',
            // 'delete' => 'admin.balances.delete'
        ];
    }
    public function index(BalancesDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('user'), route($this->route['index'])),
        ]);

    }

    // public function create(){
    //     $listUser = $this->repository->getAllUser();
    //     return view($this->view['create'], [
    //         'users' => $listUser
    //     ]);
    // }

    // public function store(BalancesRequest $request){

    //     $response = $this->service->store($request);
    //     if($response){
    //         return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
    //     }
    //     return back()->with('error', __('notifyFail'))->withInput();
    // }

    // public function edit($id){
    //     $response = $this->repository->findOrFail($id);
    //     $user = $response->user()->get()->first();
    //     return view(
    //         $this->view['edit'],
    //         [
    //             'balances' => $response,
    //             'user'=> $user
    //         ]
    //     );

    // }

    // public function update(BalancesRequest $request){

    //     $this->service->update($request);

    //     return back()->with('success', __('notifySuccess'));

    // }

    // public function delete($id){

    //     $this->service->delete($id);

    //     return to_route($this->route['index'])->with('success', __('notifySuccess'));

    // }
}
