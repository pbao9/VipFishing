<?php

namespace App\Admin\Http\Controllers\Withdraws;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Withdraws\WithdrawsRequest;
use App\Admin\Repositories\Withdraws\WithdrawsRepositoryInterface;
use App\Admin\Services\Withdraws\WithdrawsServiceInterface;
use App\Admin\DataTables\Withdraws\WithdrawsDataTable;
use App\Enums\Withdraws\WithdrawsStatus;

class WithdrawsController extends Controller
{
    public function __construct(
        WithdrawsRepositoryInterface $repository,
        WithdrawsServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;

    }

    public function getView()
    {
        return [
            'index' => 'admin.withdraws.index',
            'create' => 'admin.withdraws.create',
            'edit' => 'admin.withdraws.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.withdraws.index',
            'create' => 'admin.withdraws.create',
            'edit' => 'admin.withdraws.edit',
            'delete' => 'admin.withdraws.delete'
        ];
    }
    public function index(WithdrawsDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'status' => WithdrawsStatus::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('withdraw'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(__('withdraw'), route($this->route['index']))->add(__('addWithdraw')),
        ]);
    }

    public function store(WithdrawsRequest $request)
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
                'withdraws' => $response,
                'status' => WithdrawsStatus::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('withdraw'), route($this->route['index']))->add(__('editWithdraw')),
            ]
        );
    }

    public function update(WithdrawsRequest $request)
    {
        $response = $this->service->update($request);

        if ($response['success']) {
            return back()->with('success', $response['message']);
        }
        return back()->with('error', $response['message']);
    }

    public function delete($id)
    {
        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}