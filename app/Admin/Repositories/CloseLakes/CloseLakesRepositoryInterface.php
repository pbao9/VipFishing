<?php

namespace App\Admin\Repositories\CloseLakes;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface CloseLakesRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function getAllBookings();
    }
