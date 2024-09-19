<?php

namespace App\Admin\Http\Controllers\Notifications;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Notifications\NotificationsRequest;
use App\Admin\Repositories\Notifications\NotificationsRepositoryInterface;
use App\Admin\Services\Notifications\NotificationsServiceInterface;
use App\Admin\DataTables\Notifications\NotificationsDataTable;
use App\Enums\Notifications\NotificationStatus;

class NotificationsController extends Controller
{
    public function __construct(
        NotificationsRepositoryInterface $repository,
        NotificationsServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;


        $this->service = $service;

    }

    public function getView()
    {
        return [
            'index' => 'admin.notifications.index',
            'create' => 'admin.notifications.create',
            'edit' => 'admin.notifications.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.notifications.index',
            'create' => 'admin.notifications.create',
            'edit' => 'admin.notifications.edit',
            'delete' => 'admin.notifications.delete'
        ];
    }
    public function index(NotificationsDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'status' => NotificationStatus::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('Notifications'), route($this->route['index']))
        ]);
    }

    public function create()
    {

        return view($this->view['create'], [
            'status' => NotificationStatus::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('Notifications'), route($this->route['index']))->add(__('addNotifications'))
        ]);
    }

    public function store(NotificationsRequest $request)
    {

        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['index'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'notifications' => $response,
                'breadcrumbs' => $this->crums->add(__('Notifications'), route($this->route['index']))->add(__('editNotifications'))
            ]
        );

    }

    public function update(NotificationsRequest $request)
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