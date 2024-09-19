<?php

namespace App\Admin\Http\Controllers\Events;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Events\EventsRequest;
use App\Admin\Repositories\Events\EventsRepositoryInterface;
use App\Admin\Services\Events\EventsServiceInterface;
use App\Admin\DataTables\Events\EventsDataTable;
use App\Enums\Events\EventsCondition;
use App\Enums\Events\EventStatus;


class EventsController extends Controller
{
    public function __construct(
        EventsRepositoryInterface $repository,
        EventsServiceInterface $service,

    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.events.index',
            'create' => 'admin.events.create',
            'edit' => 'admin.events.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.events.index',
            'create' => 'admin.events.create',
            'edit' => 'admin.events.edit',
            'delete' => 'admin.events.delete'
        ];
    }
    public function index(EventsDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'status' => EventStatus::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('event'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'status' => EventStatus::asSelectArray(),
            'ec' => EventsCondition::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('event'), route($this->route['index']))->add(__('addEvent')),
        ]);
    }

    public function store(EventsRequest $request)
    {

        $response = $this->service->store($request);
        if ($response['success']) {
            return to_route($this->route['edit'], $response['id'])->with('success', $response['message']);
        }
        return back()->with('warning', $response['message'])->withInput();
    }

    public function edit($id)
    {
        $response = $this->repository->findOrFail($id);
        $currentStatus = $response->status;

        $allStatuses = EventStatus::asSelectArray();

        $statusOptions = [];
        if ($currentStatus == EventStatus::Ongoing || $currentStatus == EventStatus::Paused) {
            $statusOptions = array_filter($allStatuses, function ($key) use ($currentStatus) {
                return $key == EventStatus::Ongoing || $key == EventStatus::Paused || $key == EventStatus::Cancelled;
            }, ARRAY_FILTER_USE_KEY);
        } elseif ($currentStatus == EventStatus::NotStarted) {
            $statusOptions = array_filter($allStatuses, function ($key) use ($currentStatus) {
                return $key == $currentStatus || $key == EventStatus::Paused || $key == EventStatus::Cancelled;
            }, ARRAY_FILTER_USE_KEY);
        } else {
            // Nếu trạng thái hiện tại là Hủy hoặc Kết thúc, chỉ cho phép chọn trạng thái hiện tại
            $statusOptions = [$currentStatus => $allStatuses[$currentStatus]];
        }

        return view(
            $this->view['edit'],
            [
                'events' => $response,
                'status' => $allStatuses,
                'breadcrumbs' => $this->crums->add(__('event'), route($this->route['index']))->add(__('editEvent')),
            ]
        );
    }

    public function update(EventsRequest $request)
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
