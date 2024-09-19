<?php

namespace App\Admin\Http\Controllers\FishingRating;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\FishingRating\FishingRatingRequest;
use App\Admin\Repositories\FishingRating\FishingRatingRepositoryInterface;
use App\Admin\Services\FishingRating\FishingRatingServiceInterface;
use App\Admin\DataTables\FishingRating\FishingRatingDataTable;
use App\Enums\FishingRating\FishingRatingType;

class FishingRatingController extends Controller
{
    public function __construct(
        FishingRatingRepositoryInterface $repository, 
        FishingRatingServiceInterface $service
    ){
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(){
        return [
            'index' => 'admin.fishing_rating.index',
            'create' => 'admin.fishing_rating.create',
            'edit' => 'admin.fishing_rating.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.fishing_rating.index',
            'create' => 'admin.fishing_rating.create',
            'edit' => 'admin.fishing_rating.edit',
            'delete' => 'admin.fishing_rating.delete'
        ];
    }
    public function index(FishingRatingDataTable $dataTable){
		
        return $dataTable->render($this->view['index']);
    }

    public function create(){
        return view($this->view['create'], [
			'type_fishing_rating' => FishingRatingType::asSelectArray(),
		]);
    }

    public function store(FishingRatingRequest $request){
        $response = $this->service->store($request);
        if($response){
            return to_route($this->route['edit'], $response)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput(); 
    }

    public function edit($id){

        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'fishing_rating' => $response,
				'type_fishing_rating' => FishingRatingType::asSelectArray(),
            ]
        );

    }
 
    public function update(FishingRatingRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}
