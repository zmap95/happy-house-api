<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UtilityCollection;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    private $utilityService;

    public function __construct(UtilityService $utilityService)
    {
        $this->utilityService = $utilityService;
    }

    /**
     *
     * @OA\Get(
     *     path="/user/utilities",
     *     tags={"[Quản lý tiện nghi] API liên quan đến tiện nghi"},
     *     summary="Lấy danh sách tiện nghi",
     *     operationId="utilities.index",
     *     description="Danh sách các tiện ích chung",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="successfully operation"
     *     )
     * )
     */
    public function index() {
        $utilities = $this->utilityService->index();

        return new UtilityCollection($utilities);
    }
}
