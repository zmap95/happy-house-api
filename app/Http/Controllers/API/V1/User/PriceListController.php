<?php

namespace App\Http\Controllers\API\V1\User;

use App\Helps\ResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePriceListRequest;
use App\Http\Requests\UpdatePriceListRequest;
use App\Http\Resources\PriceListCollection;
use App\Services\PriceListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceListController extends Controller
{

    private $priceListService;

    public function __construct(PriceListService $priceListService)
    {
        $this->priceListService = $priceListService;
    }

    /**
     * @OA\Get(
     *     path="/user/pricelist",
     *     operationId="pricelist.index",
     *     summary="Danh sách bảng giá",
     *     description="Danh sách bảng giá",
     *     tags={"[Cấu hình bảng giá] API liên quan đến cấu hình bảng giá"},
     *     security={{"sanctum": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      )
     *
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price = $this->priceListService->findWhere([], ['*']);

        return new PriceListCollection($price);
    }

    /**
     * @OA\Post(
     *      path="/user/pricelist",
     *      operationId="pricelist.store",
     *      tags={"[Cấu hình bảng giá] API liên quan đến cấu hình bảng giá"},
     *      summary="Thêm mới cấu hình chi phí",
     *      description="Tạo bảng giá cho các dịch vụ như: tiền điện, nước,...v.v",
     *      security={{"sanctum": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              ref="#/components/schemas/CreatePriceListRequest"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      )
     * )
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePriceListRequest $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $price = $this->priceListService->create($data);
            DB::commit();
            $response = (new ResponseData())->setStatus(true)
                ->setMessage('Thêm thành công!')
                ->setData(
                    [
                        'price' => $price
                    ]
                )
                ->getBodyResponse();
            return response()->json($response);

        }catch (\Exception $exception){
            DB::rollBack();
            $response = (new ResponseData())->setStatus(false)
                ->setMessage('Thêm không thành công, lỗi hệ thống!')
                ->getBodyResponse();
            return response()->json($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @OA\Post(
     *      path="/user/pricelist/{priceListId}",
     *      operationId="pricelist.update",
     *      tags={"[Cấu hình bảng giá] API liên quan đến cấu hình bảng giá"},
     *      summary="Sửa cấu hình chi phí",
     *      description="Sửa bảng giá cho các dịch vụ như: tiền điện, nước,...v.v",
     *      security={{"sanctum": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              ref="#/components/schemas/UpdatePriceListRequest"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="priceListId",
     *          in="path",
     *          description="ID giá dịch vụ",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      )
     * )
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePriceListRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $price = $this->priceListService->update($data, $id);
            DB::commit();
            $response = (new ResponseData())->setStatus(true)
                ->setMessage('Sửa thành công!')
                ->setData(
                    [
                        'price' => $price
                    ]
                )
                ->getBodyResponse();
            return response()->json($response);

        }catch (\Exception $exception){
            DB::rollBack();
            $response = (new ResponseData())->setStatus(false)
                ->setMessage('Sửa không thành công, lỗi hệ thống!')
                ->getBodyResponse();
            return response()->json($exception->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *   path="/user/pricelist/{priceListId}",
     *   operationId="rooms.destroy",
     *   tags={"[Cấu hình bảng giá] API liên quan đến cấu hình bảng giá"},
     *   summary="Xóa cấu hình giá",
     *   description="Xóa cấu hình giá",
     *   security={{"sanctum": {}}},
     *   @OA\Parameter(
     *      name="priceListId",
     *      in="path",
     *      description="Nhập id giá dịch vụ",
     *      required=true,
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation"
     *   )
     * )
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $price= $this->priceListService->delete($id);
            DB::commit();
            $response = (new ResponseData())->setStatus(true)
                ->setMessage('Xóa thành công!')
                ->setData(['affected' => $price])
                ->getBodyResponse();
            return response()->json($response);

        }catch (\Exception $exception){
            DB::rollBack();
            $response = (new ResponseData())->setStatus(false)
                ->setMessage('Xóa không thành công, lỗi hệ thống!')
                ->getBodyResponse();
            return response()->json($exception->getMessage());
        }

    }
}
