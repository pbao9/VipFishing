<?php

namespace App\Admin\Http\Controllers\UserEvents;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Events\EventsRepositoryInterface;
use App\Admin\Repositories\UserEvents\UserEventsRepositoryInterface;
use App\Admin\Services\UserEvents\UserEventsServiceInterface;
use App\Admin\DataTables\UserEvents\UserEventsDataTable;


class UserEventsController extends Controller
{
    protected $eventRepository;

    public function __construct(
        UserEventsRepositoryInterface $repository,
        UserEventsServiceInterface $service,
        EventsRepositoryInterface $eventRepository,
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->eventRepository = $eventRepository;
        $this->service = $service;

    }

    public function getView()
    {
        return [
            'index' => 'admin.userEvents.index',
            // 'create' => 'admin.userEvents.create',
            // 'edit' => 'admin.userEvents.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.userEvents.index',
            // 'create' => 'admin.userEvents.create',
            // 'edit' => 'admin.userEvents.edit',
            // 'delete' => 'admin.userEvents.delete'
        ];
    }
    public function index(UserEventsDataTable $dataTable, $eventId = null)
    {
        $breadcrumbs = $this->crums->add(__('userEvent'), route($this->route['index']));

        if ($eventId) {
            // Tìm sự kiện hoặc trả về lỗi nếu không tìm thấy
            $event = $this->eventRepository->findOrFail($eventId);

            // Render với sự kiện
            return $dataTable->with('event', $event)->render($this->view['index'], [
                'event' => $event,
                'breadcrumbs' => $breadcrumbs,
            ]);
        }

        // Render không có sự kiện
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }


    // public function create(){

    //     return view($this->view['create']);
    // }

    // public function store(UserEventsRequest $request){

    //     $response = $this->service->store($request);
    //     if($response){
    //         return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
    //     }
    //     return back()->with('error', __('notifyFail'))->withInput();
    // }

    // public function edit($id){
    //     $response = $this->repository->findOrFail($id);
    //     return view(
    //         $this->view['edit'],
    //         [
    //             'userEvents' => $response,
    //             'breadcrumbs' => $this->crums->add(__('userEvent'), route($this->route['index'])),
    //         ]
    //     );

    // }

    // public function update(UserEventsRequest $request){

    //     $this->service->update($request);

    //     return back()->with('success', __('notifySuccess'));

    // }

    // public function delete($id){

    //     $this->service->delete($id);

    //     return to_route($this->route['index'])->with('success', __('notifySuccess'));

    // }
}