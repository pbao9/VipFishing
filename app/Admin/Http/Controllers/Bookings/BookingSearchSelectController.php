<?php

namespace App\Admin\Http\Controllers\Bookings;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Booking\BookingSearchSelectResource;
use App\Admin\Repositories\Bookings\BookingsRepositoryInterface;

class BookingSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        BookingsRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    protected function selectResponse()
    {
        $this->instance = [
            'results' => BookingSearchSelectResource::collection($this->instance)
        ];
    }
}