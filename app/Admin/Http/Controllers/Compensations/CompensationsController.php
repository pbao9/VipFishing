<?php

namespace App\Admin\Http\Controllers\Compensations;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Compensations\CompensationsRequest;
use App\Admin\Repositories\Compensations\CompensationsRepositoryInterface;
use App\Admin\Services\Compensations\CompensationsServiceInterface;
use App\Admin\DataTables\Compensations\CompensationsDataTable;

class CompensationsController extends Controller
{
    public function __construct(
        CompensationsRepositoryInterface $repository,
        CompensationsServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.compensations.index',
            'create' => 'admin.compensations.create',
            'edit' => 'admin.compensations.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.compensations.index',
            'create' => 'admin.compensations.create',
            'edit' => 'admin.compensations.edit',
            'delete' => 'admin.compensations.delete'
        ];
    }
    public function index(CompensationsDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('compensation'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(__('compensation'), route($this->route['index']))->add(__('addCompensation')),
        ]);
    }

    public function store(CompensationsRequest $request)
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
        return view(
            $this->view['edit'],
            [
                'compensations' => $response,
                'breadcrumbs' => $this->crums->add(__('compensation'), route($this->route['index']))->add(__('editCompensation')),
            ]
        );
    }

    public function update(CompensationsRequest $request)
    {

        $response = $this->service->update($request);

        return back()->with('success', __('notifySuccess'));
    }

    public function delete($id)
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
