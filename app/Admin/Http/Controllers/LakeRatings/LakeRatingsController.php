<?php

namespace App\Admin\Http\Controllers\LakeRatings;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\LakeRatings\RatingsRequest;
use App\Admin\Repositories\LakeRatings\LakeRatingsRepositoryInterface;
use App\Admin\Repositories\Lakes\LakesRepositoryInterface;
use App\Admin\Services\LakeRatings\LakeRatingsServiceInterface;
use App\Admin\DataTables\LakeRatings\LakeRatingsDataTable;
use App\Models\Ratings;
use Illuminate\Support\Facades\DB;


class LakeRatingsController extends Controller
{
    protected $repositoryLakes;

    public function __construct(
        LakeRatingsRepositoryInterface $repository,
        LakeRatingsServiceInterface    $service,
        LakesRepositoryInterface       $repositoryLakes,

    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->repositoryLakes = $repositoryLakes;
        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.lakeRatings.index',
            'create' => 'admin.lakeRatings.create',
            'edit' => 'admin.lakeRatings.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.lakes.rating.index',
            'create' => 'admin.lakes.rating.create',
            'edit' => 'admin.lakes.rating.edit',
            'delete' => 'admin.lakes.rating.delete'
        ];
    }

    public function index($lake_id, LakeRatingsDataTable $dataTable)
    {
        $lake = $this->repositoryLakes->findOrFail($lake_id);

        return $dataTable->render($this->view['index'], [
            "lake" => $lake,
            'breadcrumbs' => $this->crums->add(__('lake'), route('admin.lakes.index', [
            "lake_id" => $lake_id
            ]))->add(__('lakeRating')),
        ]);
    }

    public function create() {}

    public function store(RatingsRequest $request) {}

    public function edit($id) {}

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
