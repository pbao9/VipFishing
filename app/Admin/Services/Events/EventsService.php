<?php

namespace App\Admin\Services\Events;

use App\Admin\Services\Events\EventsServiceInterface;
use App\Admin\Repositories\Events\EventsRepositoryInterface;
use App\Admin\Repositories\Ranks\RanksRepository;
use App\Admin\Repositories\Ranks\RanksRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Services\File\FileService;
use App\Admin\Services\File\GalleryService;
use App\Admin\Traits\Setup;
use Illuminate\Http\Request;

class EventsService implements EventsServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $userRepository;
    protected $ranksRepository;

    protected GalleryService $fileService;
    public function __construct(
        UserRepositoryInterface $userRepository,
        RanksRepositoryInterface $ranksRepository,
        EventsRepositoryInterface $repository,
        GalleryService $fileService
    ) {
        $this->repository = $repository;
        $this->ranksRepository = $ranksRepository;
        $this->userRepository = $userRepository;
        $this->fileService = $fileService;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        $user = $this->data['user_id'];
        $userRank = $this->userRepository->find($user);
        $rank = $this->ranksRepository->find(6);

        // Kiểm tra user có đạt mức rank Đặc cấp đài sư không
        if ($userRank->rank_id == $rank->id) {
            $this->data['code'] = $this->createCodeEvent();


            $result = $this->repository->create($this->data);
            if ($result) {
                return [
                    'id' => $result->id,
                    'success' => true,
                    'message' => __('Đã tạo sự kiện thành công!')
                ];
            }
        }
        return [
            'success' => false,
            'message' => __('Vui lòng đạt mức Xếp loại ' . $rank->title . ' để tạo sự kiện')
        ];
    }

    public function update(Request $request)
    {

        $this->data = $request->validated();

        return (bool) $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return (bool) $this->repository->delete($id);
    }
}
