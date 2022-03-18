<?php

namespace App\Http\Controllers\API\V1\User;

use App\Helps\ResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\Http\Resources\HouseCollection;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\UserResource;
use App\Services\HouseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    /**
     * @var HouseService
     */
    private $houseService;

    public function __construct(HouseService $houseService)
    {
        $this->houseService = $houseService;
    }

    /**
     * @OA\Get(
     *      path="/user/houses",
     *      operationId="houses.index",
     *      tags={"[Quản lý nhà] API liên quan đến nhà"},
     *      summary="Hiển thị danh sách nhà",
     *      description="Hiển thị danh sách nhà",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *        name="search",
     *        in="query",
     *        description="Free text search",
     *        @OA\Schema(
     *           type="string",
     *        ),
     *        required=false,
     *        example="House"
     *      ),
     *      @OA\Parameter(
     *        name="order_key",
     *        in="query",
     *        description="order by key",
     *        @OA\Schema(
     *           type="string",
     *        ),
     *        required=false,
     *        example="id"
     *      ),
     *      @OA\Parameter(
     *        name="order_by",
     *        in="query",
     *        description="order by type",
     *        @OA\Schema(
     *           type="string",
     *        ),
     *        required=false,
     *        example="DESC"
     *      ),
     *      @OA\Parameter(
     *        name="category_id",
     *        in="query",
     *        description="Search by category id",
     *        @OA\Schema(
     *           type="int",
     *        ),
     *        required=false,
     *        example="1"
     *      ),
     *      @OA\Parameter(
     *        name="per_page",
     *        in="query",
     *        description="Per page",
     *        @OA\Schema(
     *           type="int",
     *        ),
     *        required=false,
     *        example="25"
     *      ),
     *      @OA\Parameter(
     *        name="page",
     *        in="query",
     *        description="Page",
     *        @OA\Schema(
     *           type="int",
     *        ),
     *        required=false,
     *        example="1"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function index(Request $request) {
        $searchCondition = $request->only([
            'search', 'per_page', 'order_by', 'order_key', 'status', 'category_id'
        ]);
        $houses = $this->houseService->getByUser(
            auth()->user()->id,
            $searchCondition,
            ['province', 'district', 'commune', 'category', 'type']
        );
        $response = (new ResponseData())->setStatus(true)
            ->setMessage("Lấy thông tin thành công")
            ->setData([
                'houses' => new HouseCollection($houses),
                'pagination' => new PaginationResource($houses)
            ])
            ->getBodyResponse();

        return response()->json($response);
    }

    /**
     * @OA\Post(
     *      path="/user/houses/store",
     *      operationId="houses.store",
     *      tags={"[Quản lý nhà] API liên quan đến nhà"},
     *      summary="Tạo mới nhà",
     *      description="Tạo mới nhà",
     *      security={{"sanctum": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              ref="#/components/schemas/CreateHouseRequest"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent()
     *      )
     * )
     */

    public function store(CreateHouseRequest $request)
    {
        DB::beginTransaction();

        try {
            $houses = $this->houseService->create($request->validated());
            DB::commit();

            $response = (new ResponseData())->setStatus(true)
                ->setMessage("Thêm nhà  thành công")
                ->setData($houses)
                ->getBodyResponse();

            return response()->json($response);
        } catch (\Exception $exception) {
            DB::rollBack();

            $response = (new ResponseData())->setStatus(false)
                ->setMessage("Thêm nhà không thành công. Đã có lỗi xảy ra.")
                ->getBodyResponse();

            return response()->json($response);
        }
    }

    /**
     * @OA\Post(
     *   path="/user/houses/{houseId}",
     *   operationId="houses.update",
     *   tags={"[Quản lý phòng] API liên quan đến phòng"},
     *   summary="Sửa phòng",
     *   description="Sửa phòng",
     *   security={{"sanctum": {}}},
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *          ref="#/components/schemas/UpdateHouseRequest"
     *       )
     *   ),
     *   @OA\Parameter(
     *      name="houseId",
     *      in="path",
     *      description="Nhập id của nhà",
     *      required=true,
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation"
     *   )
     * )
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateHouseRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $houses = $this->houseService->update($request->validated(), $id);
            DB::commit();

            $response = (new ResponseData())->setStatus(true)
                ->setMessage("Sửa thông tin nhà  thành công")
                ->setData($houses)
                ->getBodyResponse();

            return response()->json($response);
        } catch (\Exception $exception) {
            DB::rollBack();

            $response = (new ResponseData())->setStatus(false)
                ->setMessage("Sửa thông tin nhà không thành công. Đã có lỗi xảy ra.")
                ->getBodyResponse();

            return response()->json($exception->getMessage());
        }
    }
}
