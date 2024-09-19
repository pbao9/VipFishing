<?php

namespace App\Admin\Http\Controllers\UserScores;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\UserScores\UserScoresRequest;
use App\Admin\Repositories\UserScores\UserScoresRepositoryInterface;
use App\Admin\Services\UserScores\UserScoresServiceInterface;
use App\Admin\DataTables\UserScores\UserScoresDataTable;


class UserScoresController extends Controller
{
    public function __construct(
        UserScoresRepositoryInterface $repository, 
        UserScoresServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.userScores.index',
            'create' => 'admin.userScores.create',
            'edit' => 'admin.userScores.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.userScores.index',
            'create' => 'admin.userScores.create',
            'edit' => 'admin.userScores.edit',
            'delete' => 'admin.userScores.delete'
        ];
    }
    public function index(UserScoresDataTable $dataTable){
        return $dataTable->render($this->view['index']);
    }

    public function create(){

        return view($this->view['create']);
    }

    public function store(UserScoresRequest $request){

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
                'userScores' => $response
            ]
        );

    }
 
    public function update(UserScoresRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}