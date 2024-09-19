<?php

namespace App\Admin\Services\Lakes;

use Exception;
use App\Admin\Services\Lakes\LakesServiceInterface;
use App\Admin\Repositories\Lakes\LakesRepositoryInterface;
use App\Models\Lakechilds;
use App\Models\Lakes;
use Illuminate\Http\Request;

class LakesService implements LakesServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;

    protected LakesRepositoryInterface $repository;

    public function __construct(LakesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        $data['longitude'] = $data['lat'];
        $data['latitude'] = $data['lng'];
        return $this->repository->create($data);
    }

    public function update(Request $request): object
    {
        $data = $request->validated();
        $id = $data['id'];

        $updateResult = $this->repository->update($id, $data);
        
        $lake = Lakes::find($id);
        if ($lake) {
            $newStatus = $lake->status;
            $lake->lakechilds()->update(['status' => $newStatus]);
        }

        return $updateResult;
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
