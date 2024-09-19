<?php

namespace App\Admin\Http\Controllers\User;

use App\Admin\DataTables\TransactionHistory\TransactionHistoryDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\User\UserRequest;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Services\User\UserServiceInterface;
use App\Admin\DataTables\User\UserDataTable;
use App\Enums\TransactionHistory\TransactionHistoryType;
use App\Enums\User\{UserVip, UserGender};

class UserController extends Controller
{
    public function __construct(
        UserRepositoryInterface $repository,
        UserServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;

        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'edit' => 'admin.users.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.user.index',
            'create' => 'admin.user.create',
            'edit' => 'admin.user.edit',
            'delete' => 'admin.user.delete'
        ];
    }
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'gender' => UserGender::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('user'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'gender' => UserGender::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('user'), route($this->route['index']))->add(__('addUser')),
        ]);
    }

    public function store(UserRequest $request)
    {
        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $instance = $this->repository->findOrFail($id);
        $instance->load(['refer', 'refer_1', 'refer_2', 'refer_3', 'referParent_1', 'referParent']);
        $bookingHistoryTransaction = $instance->transactionHistories()->where('transaction_type', TransactionHistoryType::Booking)->get();
        $depositWithdrawHistoryTransaction = $instance->transactionHistories()->where('transaction_type', [
            TransactionHistoryType::Deposit,
            TransactionHistoryType::Withdraw,
            TransactionHistoryType::Commission,
            TransactionHistoryType::Compensation,
            TransactionHistoryType::Refund
        ])->get();
        return view(
            $this->view['edit'],
            [
                'user' => $instance,
                'bookingHistoryTransaction' => $bookingHistoryTransaction,
                'depositWithdrawHistoryTransaction' => $depositWithdrawHistoryTransaction,
                'gender' => UserGender::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('user'), route($this->route['index']))->add(__('editUser')),
            ]
        );
    }

    public function update(UserRequest $request)
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
