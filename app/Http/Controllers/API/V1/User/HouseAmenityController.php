<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\HouseAmenityCollection;
use App\Services\HouseAmenityService;
use Illuminate\Http\Request;

class HouseAmenityController extends Controller
{
    private $houseAmenityService;

    public function __construct(HouseAmenityService $houseAmenityService)
    {
        $this->houseAmenityService = $houseAmenityService;
    }

    /**
     * @OA\Get(
     *     path="/user/houses/{houseId}/amenities",
     *     summary="Lấy tiện ích của nhà",
     *     tags={"[Quản lý tiện nghi nhà] API liên quan đến tiện nghi trong nhà"},
     *     description="Lấy các tiện ích có trong nhà",
     *     operationId="findByHouse",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *          name="houseId",
     *          in="path",
     *          description="Nhập id của nhà",
     *          required=true
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation"
     *     )
     *
     * )
     * @param $houseId
     * @return mixed
     */
    public function findByHouse($houseId) {
        $houseAmenities = $this->houseAmenityService->findByHouse($houseId);

        return new HouseAmenityCollection($houseAmenities);
    }
}
