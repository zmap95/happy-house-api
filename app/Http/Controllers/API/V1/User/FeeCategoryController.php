<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Services\FeeCategoryService;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    private $feeCategoryService;

    public function __construct(FeeCategoryService $feeCategoryService)
    {
        $this->feeCategoryService = $feeCategoryService;
    }

    /**
     * @OA\Get(
     *     path="/user/fee/categories",
     *     summary="Lấy danh mục các loại phí",
     *     description="Lấy danh mục phí để cấu hình bảng giá",
     *     tags={"[API quản lý danh mục phí] Các API liên quan đến danh mục phí"},
     *     security={{"sanctum": {}}},
     *     operationId="getFeeCategory",
     *     @OA\Response(
     *          response=200,
     *          description="successful operation"
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad request"
     *     ),
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFeeCategory() {
        $feeCategories = $this->feeCategoryService->getFeeCategory();

        return response()->json($feeCategories);
    }
}
