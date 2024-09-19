<?php

namespace App\Admin\Http\Controllers\CommissionHistory;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\CommissionHistory\CommissionHistoryRequest;
use App\Admin\Repositories\CommissionHistory\CommissionHistoryRepositoryInterface;
use App\Admin\Services\CommissionHistory\CommissionHistoryServiceInterface;
use App\Admin\DataTables\CommissionHistory\CommissionHistoryDataTable;


class CommissionHistoryController extends Controller
{
    public function __construct(
        CommissionHistoryRepositoryInterface $repository,
        CommissionHistoryServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;

    }

    public function getView()
    {
        return [
            'index' => 'admin.commissionHistory.index',
            'create' => 'admin.commissionHistory.create',
            'edit' => 'admin.commissionHistory.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.commissionHistory.index',
            'create' => 'admin.commissionHistory.create',
            'edit' => 'admin.commissionHistory.edit',
            'delete' => 'admin.commissionHistory.delete'
        ];
    }
    public function index(CommissionHistoryDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('commission'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(__('commission'), route($this->route['index']))->add(__('addCommission')),
        ]);
    }

    public function store(CommissionHistoryRequest $request)
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
                'commissionHistory' => $response,
                'breadcrumbs' => $this->crums->add(__('commission'), route($this->route['index']))->add(__('editCommission')),
            ]
        );

    }

    public function update(CommissionHistoryRequest $request)
    {

        $response = $this->service->update($request);

        if ($response) {
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