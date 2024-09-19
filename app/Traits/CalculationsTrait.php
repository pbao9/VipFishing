<?php

namespace App\Traits;

use App\Admin\Repositories\Area\AreaRepositoryInterface;
use App\Enums\Area\AreaStatus;
use App\Models\Area;
use Exception;

trait CalculationsTrait
{

    /**
     * Lấy thông tin khu vực dựa trên tọa độ địa lý được cung cấp.
     *
     * @param float $lat Vĩ độ của địa điểm giao hàng.
     * * @param float $lng Kinh độ của địa điểm giao hàng.
     * @return Area|null Trả về đối tượng khu vực nếu tìm thấy, ngược lại trả về null nếu không tìm thấy khu vực nào.
     * @throws Exception
     */
    public function getArea(float $lat, float $lng): ?Area
    {
        $areaRepository = app(AreaRepositoryInterface::class);
        if ($lat && $lng) {
            $areaId = $this->getAreaIdByCoordinates($lat, $lng);
            return $areaRepository->findOrFail($areaId);
        }
        return null;
    }

    /**
     * Checks whether given coordinates are within any active area and returns the ID of that area.
     *
     * This function retrieves a list of active areas (status 'On') from the repository.
     * It then iterates through each area and uses the `isCoordinateInArea` function to determine
     * if the given coordinates fall within that area based on the area's address.
     *
     * @param float $lat Latitude of the coordinate to be checked.
     * @param float $lng Longitude of the coordinate to be checked.
     * @return int|null Returns the ID of the area if the coordinates are within an area, otherwise returns null.
     */
    function getAreaIdByCoordinates(float $lat, float $lng): ?int
    {
        $areaRepository = app(AreaRepositoryInterface::class);
        $areas =$areaRepository->getBy(['status' => AreaStatus::On]);
        foreach ($areas as $area) {
            if (isCoordinateInArea($lat, $lng, json_decode($area->boundaries, true))) {
                return $area->id;
            }
        }

        return null;
    }

}
