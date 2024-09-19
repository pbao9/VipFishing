<?php

namespace App\Admin\Http\Controllers\Deposits;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Deposits\DepositsRequest;
use App\Admin\Repositories\Deposits\DepositsRepositoryInterface;
use App\Admin\Services\Deposits\DepositsServiceInterface;
use App\Admin\DataTables\Deposits\DepositsDataTable;
use App\Enums\Deposits\DepositsStatus;
use App\Enums\Deposits\DepositType;

class DepositsController extends Controller
{
    public function __construct(
        DepositsRepositoryInterface $repository,
        DepositsServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.deposits.index',
            'create' => 'admin.deposits.create',
            'edit' => 'admin.deposits.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.deposits.index',
            'create' => 'admin.deposits.create',
            'edit' => 'admin.deposits.edit',
            'delete' => 'admin.deposits.delete'
        ];
    }
    public function index(DepositsDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'status' => DepositsStatus::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('deposit'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'type' => DepositType::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('deposit'), route($this->route['index']))->add(__('addDeposit')),
        ]);
    }

    public function store(DepositsRequest $request)
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
                'deposits' => $response,
                'type' => DepositType::asSelectArray(),
                'status' => DepositsStatus::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('deposit'), route($this->route['index']))->add(__('editDeposit')),
            ]
        );
    }

    public function update(DepositsRequest $request)
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
