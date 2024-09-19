<?php

namespace App\Admin\Http\Controllers\CloseLakes;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\CloseLakes\CloseLakesRequest;
use App\Admin\Repositories\CloseLakes\CloseLakesRepositoryInterface;
use App\Admin\Services\CloseLakes\CloseLakesServiceInterface;
use App\Admin\DataTables\CloseLakes\CloseLakesDataTable;
use App\Models\Bookings;


class CloseLakesController extends Controller
{
    public function __construct(
        CloseLakesRepositoryInterface $repository,
        CloseLakesServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;


        $this->service = $service;

    }

    public function getView()
    {
        return [
            'index' => 'admin.closeLakes.index',
            'create' => 'admin.closeLakes.create',
            'edit' => 'admin.closeLakes.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.closeLakes.index',
            'create' => 'admin.closeLakes.create',
            'edit' => 'admin.closeLakes.edit',
            'delete' => 'admin.closeLakes.delete'
        ];
    }
    public function index(CloseLakesDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('closeLake'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        $listBookings = $this->repository->getAllBookings();
        return view($this->view['create'], [
            'bookings' => $listBookings,
            'breadcrumbs' => $this->crums->add(__('closeLake'), route($this->route['index']))->add(__('addCloseLake')),
        ]);
    }

    public function store(CloseLakesRequest $request)
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
                'closeLakes' => $response,
                'breadcrumbs' => $this->crums->add(__('closeLake'), route($this->route['index']))->add(__('editCloseLake')),
            ]
        );

    }

    public function update(CloseLakesRequest $request)
    {

        $response = $this->service->update($request);

        if($response){
            return back()->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();

    }

    public function delete($id)
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));

    }
}
