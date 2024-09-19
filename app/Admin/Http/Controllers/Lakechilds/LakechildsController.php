<?php

namespace App\Admin\Http\Controllers\Lakechilds;

use App\Enums\Lakechilds\DayOfWeek;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Lakechilds\LakechildsRequest;
use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Admin\Services\Lakechilds\LakechildsServiceInterface;
use App\Admin\DataTables\Lakechilds\LakechildsDataTable;
use App\Admin\Repositories\Lakes\LakesRepositoryInterface;
use App\Enums\Lakechilds\LakechildsStatus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LakechildsController extends Controller
{
    protected $repository;
    protected $service;
    protected $repositoryLakes;

    public function __construct(
        LakechildsRepositoryInterface $repository,
        LakechildsServiceInterface    $service,
        LakesRepositoryInterface      $repositoryLakes,
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->repositoryLakes = $repositoryLakes;
        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.lakes.items.index',
            'create' => 'admin.lakes.items.create',
            'edit' => 'admin.lakes.items.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.lakes.item.index',
            'create' => 'admin.lakes.item.create',
            'edit' => 'admin.lakes.item.edit',
            'delete' => 'admin.lakes.item.delete'
        ];
    }


    public function index($lake_id, LakechildsDataTable $dataTable)
    {
        $lake = $this->repositoryLakes->findOrFail($lake_id);

        return $dataTable->with('lake', $lake)->render($this->view['index'], [
            'lake' => $lake,
            'breadcrumbs' => $this->crums->add(__('lake'), route('admin.lakes.index', [
                "lake_id" => $lake_id
            ]))->add(__('lakeChild')),
        ]);
    }

    public function create($lake_id)
    {
        $lake = $this->repositoryLakes->findOrFail($lake_id);
        $listFishingSet = $this->repository->getAllFishingSets();
        $daysOfWeek = DayOfWeek::getValues();
        return view($this->view['create'], compact('lake', 'daysOfWeek'), [
            'lakechildStatus' => LakechildsStatus::asSelectArray(),
            'fishingSets' => $listFishingSet,
            'breadcrumbs' => $this->crums->add(__('lake'), route('admin.lakes.index'))->add(
                __('lakeChild'),
                route('admin.lakes.item.index', ['lake_id' => $lake_id])
            )->add(__('addLakeChild')),
        ]);
    }

    public function store(LakechildsRequest $request)
    {
        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['edit'], $response)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $listFishingSets = $this->repository->getAllFishingSets();
        $lakeChilds = $this->repository->findOrFailWithRelations($id);
        $daysOfWeek = DayOfWeek::getValues();
        $totalRateValue = $this->repository->getTotalRateValue($id);

        return view(
            $this->view['edit'],
            compact('daysOfWeek'),
            [
                'fishingSets' => $listFishingSets,
                'lakechilds' => $lakeChilds,
                'status' => LakechildsStatus::asSelectArray(),
                'breadcrumbs' => $this->crums->add(__('lake'), route('admin.lakes.index'))->add(
                    __('lakeChild'),
                    route('admin.lakes.item.index', ['lake_id' => $lakeChilds->lake_id])
                )->add(__('editLakeChild')),
                'totalRateValue' => $totalRateValue,
                'avgRate' => $lakeChilds->avgRating(),
            ]
        );
    }

    public function update(LakechildsRequest $request)
    {
        $this->service->update($request);
        return back()->with('success', __('notifySuccess'));
    }

    public function delete($lake_id, $id)
    {
        $this->service->delete($id);
        return to_route($this->route['index'], $lake_id)->with('success', __('notifySuccess'));
    }
}
