<?php

namespace App\Admin\Http\Controllers\Ratings;

use App\Admin\DataTables\Ratings\RatingsDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Ratings\RatingsRequest;
use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;
use App\Admin\Repositories\Ratings\RatingsRepositoryInterface;
use App\Admin\Services\Ratings\RatingsServiceInterface;
use Illuminate\Support\Facades\DB;


class RatingsController extends Controller
{

    protected $bookingRepository;

    public function __construct(
        RatingsRepositoryInterface  $repository,
        BookingsRepositoryInterface $bookingRepository,
        RatingsServiceInterface     $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->bookingRepository = $bookingRepository;
        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.ratings.index',
            'create' => 'admin.ratings.create',
            'edit' => 'admin.ratings.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.ratings.index',
            'create' => 'admin.ratings.create',
            'edit' => 'admin.ratings.edit',
            'delete' => 'admin.ratings.delete'
        ];
    }

    public function index(RatingsDataTable $dataTable)
    {
        return $dataTable->render($this->view['index']);
    }

    public function create()
    {
        $joinlake = DB::table('lakes')->get();
        $joinlakechild = DB::table('lake_childs')->get();
        $joinbooking = $this->bookingRepository->getByStatus(3);

        return view($this->view['create'], compact('joinlake', 'joinlakechild', 'joinbooking'), [
            'breadcrumbs' => $this->crums->add(__('rating'), route($this->route['index']))->add(__('addRating')),
        ]);
    }

    public function store(RatingsRequest $request)
    {
        $response = $this->service->store($request);

        if (is_array($response) && isset($response['error'])) {
            return back()->with('error', $response['error'])->withInput();
        }

        if ($response) {
            return back()->with('success', __('notifySuccess'))->withInput();
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {

        $response = $this->repository->findOrFail($id)->load(['booking']);

        return view(
            $this->view['edit'],
            [
                'ratings' => $response,
                'lake' => $response->lake,
                'lakechild' => $response->lakechild,
                'booking' => $response->booking,
                'breadcrumbs' => $this->crums->add(__('rating'), route($this->route['index']))->add(__('editRating')),
            ],
        );
    }

    public function update(RatingsRequest $request)
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
