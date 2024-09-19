<?php

namespace App\Admin\Http\Controllers\Lakes;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Lakes\LakesRequest;
use App\Admin\Repositories\Lakes\LakesRepositoryInterface;
use App\Admin\Services\Lakes\LakesServiceInterface;
use App\Admin\DataTables\Lakes\LakesDataTable;
use App\Admin\Repositories\Provinces\ProvincesRepositoryInterface;
use App\Enums\Lakes\StatusLake;
use App\Models\Lakechilds;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

class LakesController extends Controller
{
    protected $repository;
    protected $service;
    protected $provincesRepository;

    public function __construct(
        LakesRepositoryInterface $repository,
        LakesServiceInterface $service,
        ProvincesRepositoryInterface $provincesRepository
    ) {

        parent::__construct();

        $this->repository = $repository;

        $this->service = $service;

        $this->provincesRepository = $provincesRepository;
    }

    public function getView()
    {
        return [
            'index' => 'admin.lakes.index',
            'create' => 'admin.lakes.create',
            'edit' => 'admin.lakes.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.lakes.index',
            'create' => 'admin.lakes.create',
            'edit' => 'admin.lakes.edit',
            'delete' => 'admin.lakes.delete'
        ];
    }

    public function index(LakesDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('lake'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'status' => StatusLake::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('lake'), route($this->route['index']))->add(__('addLake')),
        ]);
    }

    public function store(LakesRequest $request)
    {

        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $response = $this->repository->findOrFail($id);
        $totalRate = $response->countRating();
        $avgRate = $response->avgRating();
        $countLakeChild = $response->countLakechilds();
        return view(
            $this->view['edit'],
            [
                'countLakeChild' => $countLakeChild,
                'lakes' => $response,
                'breadcrumbs' => $this->crums->add(__('lake'), route($this->route['index']))->add(__('editLake')),
                'totalRate' => $totalRate,
                'avgRate' => $avgRate,
                'status' => StatusLake::asSelectArray(),
            ]
        );
    }

    public function update(LakesRequest $request)
    {

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));
    }

    public function delete($id)
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
