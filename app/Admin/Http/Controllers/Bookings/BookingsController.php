<?php

namespace App\Admin\Http\Controllers\Bookings;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Bookings\BookingsRequest;
use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;
use App\Admin\Repositories\Lakechilds\OperatingRepositoryInterface;
use App\Admin\Services\Bookings\BookingsServiceInterface;
use App\Admin\DataTables\Bookings\BookingsDataTable;
use App\Admin\Repositories\Deposits\DepositsRepositoryInterface;
use App\Admin\Repositories\Ratings\RatingsRepositoryInterface;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Bookings\BookingsStatus;
use App\Enums\Ratings\RateStatus;
use App\Models\Lakechilds;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class BookingsController extends Controller
{

    protected $activityDayRepositry;
    protected $ratingRepository;
    protected $depositRepository;
    protected $settingRepository;

    public function __construct(
        BookingsRepositoryInterface  $repository,
        OperatingRepositoryInterface $activityDayRepositry,
        BookingsServiceInterface     $service,
        RatingsRepositoryInterface   $ratingRepository,
        DepositsRepositoryInterface  $depositsRepository,
        SettingRepositoryInterface $settingRepository,

    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->activityDayRepositry = $activityDayRepositry;
        $this->service = $service;
        $this->ratingRepository = $ratingRepository;
        $this->depositRepository = $depositsRepository;
        $this->settingRepository = $settingRepository;
    }

    public function getView()
    {
        return [
            'index' => 'admin.bookings.index',
            'create' => 'admin.bookings.create',
            'edit' => 'admin.bookings.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.bookings.index',
            'create' => 'admin.bookings.create',
            'edit' => 'admin.bookings.edit',
            'delete' => 'admin.bookings.delete'
        ];
    }
    public function index(BookingsDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'status' => BookingsStatus::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('booking'), route($this->route['index'])),
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(__('booking'), route($this->route['index']))->add(__('addBooking')),
        ]);
    }

    public function store(BookingsRequest $request)
    {

        $response = $this->service->store($request);
        if ($response['success']) {
            return to_route($this->route['edit'], $response['id'])->with('success', $response['message']);
        }
        return back()->with('error', $response['message'])->withInput();
    }

    public function getActivityDates(Request $request)
    {
        $lakechildId = $request->input('lake_child_id');
        $activityDates = $this->activityDayRepositry->searchAllLimit('', ['lake_child_id' => $lakechildId]);

        $data = [
            'success' => true,
            'activity_dates' => $activityDates->pluck('activity_date')->toArray(),
        ];

        return response()->json($data);
    }

    public function edit($id)
    {
        $response = $this->repository->findOrFail($id);
        $deposit = $this->depositRepository->existByBookingID($id);
        $ratings = $this->ratingRepository->getByBookingId($id);
        return view(
            $this->view['edit'],
            [
                'bookings' => $response,
                'ratings' => $ratings,
                'deposits' => $deposit,
                'status' => BookingsStatus::asSelectArray(),
                'rateStatus' => RateStatus::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('booking'), route($this->route['index']))->add(__('editBooking')),
            ]
        );
    }

    public function update(BookingsRequest $request)
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
    public function getBookingInfo($lakechildId)
    {
        $lakechild = Lakechilds::with('bookings')->findOrFail($lakechildId);

        $canceledBookings = $lakechild->bookings->count();
        $totalRefundAmount = $lakechild->bookings->sum('refund_amount'); // Assuming there is a refund_amount field in bookings table
        $compensationAmount = $lakechild->bookings->sum('compensation_amount'); // Assuming there is a compensation_amount field in bookings table

        return response()->json([
            'canceled_bookings' => $canceledBookings,
            'total_refund_amount' => $totalRefundAmount,
            'compensation_amount' => $compensationAmount,
        ]);
    }
}
