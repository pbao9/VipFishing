<?php

namespace App\Admin\Http\Controllers\Fishs;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Fishs\FishsRequest;
use App\Admin\Repositories\Fishs\FishsRepositoryInterface;
use App\Admin\Services\Fishs\FishsServiceInterface;
use App\Admin\DataTables\Fishs\FishsDataTable;
use App\Admin\Repositories\Provinces\ProvincesRepositoryInterface;


class FishsController extends Controller
{
    protected $repository;
    protected $service;
    protected $provincesRepository;
    public function __construct(
        FishsRepositoryInterface $repository,
        FishsServiceInterface $service,
        ProvincesRepositoryInterface $provincesRepository
    ){

        parent::__construct();

        $this->repository = $repository;


        $this->service = $service;

        $this->provincesRepository = $provincesRepository;

    }

    public function getView(){
        return [
            'index' => 'admin.fishs.index',
            'create' => 'admin.fishs.create',
            'edit' => 'admin.fishs.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.fishs.index',
            'create' => 'admin.fishs.create',
            'edit' => 'admin.fishs.edit',
            'delete' => 'admin.fishs.delete'
        ];
    }
    public function index(FishsDataTable $dataTable){
        return $dataTable->render($this->view['index'],[
            'breadcrumbs' => $this->crums->add(__('Fishs'), route($this->route['index']))
        ]);
    }

    public function create(){
        return view($this->view['create'],[
            'breadcrumbs' => $this->crums->add(__('Fishs'), route($this->route['index']))->add(__('addFishs'))
        ]
    );
    }

    public function store(FishsRequest $request){

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
                'fishs' => $response,
                'breadcrumbs' => $this->crums->add(__('Fishs'), route($this->route['index']))->add(__('editFishs'))
            ]
        );

    }

    public function update(FishsRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));

    }
}
