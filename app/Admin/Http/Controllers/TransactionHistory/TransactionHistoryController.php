<?php

namespace App\Admin\Http\Controllers\TransactionHistory;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\TransactionHistory\TransactionHistoryRequest;
use App\Admin\Repositories\TransactionHistory\TransactionHistoryRepositoryInterface;
use App\Admin\Services\TransactionHistory\TransactionHistoryServiceInterface;
use App\Admin\DataTables\TransactionHistory\TransactionHistoryDataTable;
use App\Enums\TransactionHistory\TransactionHistoryType;

class TransactionHistoryController extends Controller
{
    public function __construct(
        TransactionHistoryRepositoryInterface $repository,
        TransactionHistoryServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;

    }

    public function getView()
    {
        return [
            'index' => 'admin.transactionHistory.index',
            'create' => 'admin.transactionHistory.create',
            'edit' => 'admin.transactionHistory.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.transactionHistory.index',
            'create' => 'admin.transactionHistory.create',
            'edit' => 'admin.transactionHistory.edit',
            'delete' => 'admin.transactionHistory.delete'
        ];
    }
    public function index(TransactionHistoryDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'transaction_type' => TransactionHistoryType::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('transactionHistory'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'transaction_type' => TransactionHistoryType::asSelectArray(),
        ]);
    }

    public function store(TransactionHistoryRequest $request)
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
                'transactionHistory' => $response,
                'transaction_type' => TransactionHistoryType::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('transactionHistory'), route($this->route['index']))->add(__('detailTransactionHistory')),
            ]
        );

    }

    public function update(TransactionHistoryRequest $request)
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