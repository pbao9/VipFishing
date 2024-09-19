<?php

namespace App\Admin\Http\Controllers\LakeChildRatings;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\LakeChildRatings\LakeChildRatingsRequest;
use App\Admin\Repositories\LakeChildRatings\LakeChildRatingsRepositoryInterface;
use App\Admin\Repositories\Lakechilds\LakechildsRepositoryInterface;
use App\Admin\Services\LakeChildRatings\LakeChildRatingsServiceInterface;
use App\Admin\DataTables\LakeChildRatings\LakeChildRatingsDataTable;
use App\Models\Ratings;
use Illuminate\Support\Facades\DB;


class LakeChildRatingsController extends Controller
{
    protected $repositoryLakeChild;

    public function __construct(
        LakeChildRatingsRepositoryInterface $repository,
        LakeChildRatingsServiceInterface    $service,
        LakechildsRepositoryInterface       $repositoryLakeChild,

    )
    {

        parent::__construct();

        $this->repository = $repository;
        $this->repositoryLakeChild = $repositoryLakeChild;
        $this->service = $service;

    }

    public function getView()
    {
        return [
            'index' => 'admin.lakeChildRatings.index',
            'create' => 'admin.lakeChildRatings.create',
            'edit' => 'admin.lakeChildRatings.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.lakes.item.rating.index',
            'create' => 'admin.lakes.item.rating.rating.create',
            'edit' => 'admin.lakes.item.rating.rating.edit',
            'delete' => 'admin.lakes.item.rating.rating.delete'
        ];
    }

    public function index($lakechild_id, LakeChildRatingsDataTable $dataTable)
    {
        $lakeChild = $this->repositoryLakeChild->findOrFail($lakechild_id);
        return $dataTable->render($this->view['index'], [
            "lakeChild" => $lakeChild,
            'breadcrumbs' => $this->crums->add(__('lakeChild'), route('admin.lakes.item.edit', [
                "id" => $lakechild_id
            ]))->add(__('lakeChildRating')),
        ]);
    }

    public function create()
    {

    }

    public function store(LakeChildRatingsRequest $request)
    {
    }

    public function edit($id)
    {
    }

    public function update(LakeChildRatingsRequest $request)
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
