<?php

namespace App\Admin\Http\Controllers\BookingLake;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\BookingLake\BookingLakeRepositoryInterface;
use App\Admin\Services\BookingLake\BookingLakeServiceInterface;
use App\Admin\DataTables\BookingLake\BookingLakeDataTable;
use Illuminate\Support\Facades\DB;

class BookingLakeController extends Controller
{
    public function __construct(
        BookingLakeRepositoryInterface $repository,
        BookingLakeServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;


        $this->service = $service;

    }

    public function getView()
    {
        return [
            'index' => 'admin.bookingLake.index',
            // 'create' => 'admin.bookingLake.create',
            // 'edit' => 'admin.bookingLake.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.bookingLake.index',
            // 'create' => 'admin.bookingLake.create',
            // 'edit' => 'admin.bookingLake.edit',
            // 'delete' => 'admin.bookingLake.delete'
        ];
    }
    public function index(BookingLakeDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('booking'), route($this->route['index'])),
        ]);
    }

    // public function create(){

    //     $joinbooking = DB::table('bookings')->get();
    //     $joinvariationFishs = DB::table('variationFishs')->get();
    //     return view($this->view['create'], compact('joinbooking', 'joinvariationFishs'));
    // }
    // public function create()
    // {
    //     $listBooking = $this->repository->getAllBooking();
    //     $listVariationFish = $this->repository->getAllVariationFish();
    //     return view($this->view['create'], [
    //         'bookings' => $listBooking,
    //         'variationFishes' => $listVariationFish
    //     ]);
    // }

    // public function store(BookingLakeRequest $request)
    // {

    //     $response = $this->service->store($request);
    //     if ($response) {
    //         return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
    //     }
    //     return back()->with('error', __('notifyFail'))->withInput();
    // }

    // public function edit($id)
    // {
    //     $response = $this->repository->findOrFail($id);

    //     $joinbooking = DB::table('bookings')->get();
    //     $joinvariationFishs = DB::table('variationFishs')->get();

    //     return view(
    //         $this->view['edit'],
    //         [
    //             'bookingLake' => $response
    //         ], compact('joinbooking', 'joinvariationFishs')
    //     );

    // public function edit($id)
    // {
    //     $response = $this->repository->findOrFail($id);
    //     $listBooking = $this->repository->getAllBooking();
    //     $listVariationFish = $this->repository->getAllVariationFish();
    //     return view(
    //         $this->view['edit'],
    //         [
    //             'bookingLake' => $response,
    //             'bookings' => $listBooking,
    //             'variationFishes' => $listVariationFish
    //         ]
    //     );

    // }

    // public function update(BookingLakeRequest $request)
    // {

    //     $response = $this->service->update($request);

    //     if($response){
    //         return back()->with('success', __('notifySuccess'));
    //     }
    //     return back()->with('error', __('notifyFail'))->withInput();

    // }

    // public function delete($id)
    // {

    //     $this->service->delete($id);

    //     return to_route($this->route['index'])->with('success', __('notifySuccess'));

    // }
}