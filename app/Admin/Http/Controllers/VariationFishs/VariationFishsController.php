<?php

namespace App\Admin\Http\Controllers\VariationFishs;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\VariationFishs\VariationFishsRequest;
use App\Admin\Repositories\VariationFishs\VariationFishsRepositoryInterface;
use App\Admin\Services\VariationFishs\VariationFishsServiceInterface;
use App\Admin\DataTables\VariationFishs\VariationFishsDataTable;
use App\Admin\Repositories\Fishs\FishsRepositoryInterface;
use App\Admin\Repositories\Provinces\ProvincesRepositoryInterface;
use Illuminate\Support\Facades\DB;

class VariationFishsController extends Controller
{
    protected $repository;
    protected $service;
    protected $fishsRepository;

    protected $provincesRepository;
    public function __construct(
        VariationFishsRepositoryInterface $repository,
        VariationFishsServiceInterface $service,
        FishsRepositoryInterface $fishsRepository,
        ProvincesRepositoryInterface $provincesRepository
    ) {

        parent::__construct();

        $this->repository = $repository;


        $this->service = $service;

        $this->fishsRepository = $fishsRepository;

        $this->provincesRepository = $provincesRepository;
    }

    public function getView()
    {
        return [
            'index' => 'admin.variationFishs.index',
            'create' => 'admin.variationFishs.create',
            'edit' => 'admin.variationFishs.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.fishs.item.index',
            'create' => 'admin.fishs.item.create',
            'edit' => 'admin.fishs.item.edit',
            'delete' => 'admin.fishs.item.delete'
        ];
    }
    public function index($fish_id, VariationFishsDataTable $dataTable)
    {
        if ($fish_id) {
            $new_filter = ['id' => $fish_id];
            $fish = $this->fishsRepository->getBy($new_filter, ['provinces'])->first();
            // $variationFishs = $this->repository->findOrFail($fish_id);
            $data = $dataTable->render($this->view['index'], [
                "fromFish" => $fish_id,
                "fish" => $fish,
                // 'variationFishs' => $variationFishs,
                'breadcrumbs' => $this->crums->add(__('Fishs'), route('admin.fishs.index'))->add(__('variationFishs'))
            ]);
            return $data;
        }
    }

    public function create($fish_id)
    {
        if ($fish_id) {
            $new_filter = ['id' => $fish_id];
            $fish = $this->fishsRepository->getBy($new_filter, ['provinces'])->first();
            return view($this->view['create'], [
                "fish_id" => $fish_id,
                "fish" => $fish,
                'breadcrumbs' => $this->crums->add(__('Fishs'), route('admin.fishs.index'))->add(__('variationFishs'), route('admin.fishs.item.index', [
                    "fish_id" => $fish_id
                ]))->add(__('addVariationFishs')),
            ]);
        } else {
            return view($this->view['create']);
        }
    }

    public function store(VariationFishsRequest $request)
    {

        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $variationFishs = $this->repository->findOrFailWithRelations($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(__('Fishs'), route('admin.fishs.index'))->add(__('variationFishs'), route('admin.fishs.item.index', [
                "fish_id" => $variationFishs->fish_id
            ]))->add(__('addVariationFishs')),
            'variationFishs' => $variationFishs,
        ]);
    }

    public function update(VariationFishsRequest $request)
    {

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));
    }

    public function delete($fish_id, $id)
    {
        $this->service->delete($id);
        return to_route($this->route['index'], $fish_id)->with('success', __('notifySuccess'));
    }
}
