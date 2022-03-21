<?php

namespace App\Http\Controllers\API\V1\User;

use App\Helps\ResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomCollection;
use App\Http\Resources\RoomResource;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    private $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * @OA\Get(
     *     path="/user/rooms",
     *     operationId="rooms.index",
     *     summary="Danh sách phòng",
     *     description="Danh sách phòng",
     *     tags={"[Quản lý phòng] API liên quan đến phòng"},
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
        $rooms = $this->roomService->findWhere([], ['*']);

        return new RoomCollection($rooms);
    }

    /**
     * @OA\Post(
     *   path="/user/rooms",
     *   operationId="rooms.store",
     *   tags={"[Quản lý phòng] API liên quan đến phòng"},
     *   summary="Thêm mới phòng",
     *   description="Thêm mới phòng",
     *   security={{"sanctum": {}}},
     *   @OA\RequestBody(
     *     required=true,
     *        @OA\JsonContent(
     *            ref="#/components/schemas/CreateRoomRequest"
     *        )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation"
     *   )
     * )
     */

    public function store(CreateRoomRequest $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $room = $this->roomService->create($data);
            DB::commit();
            $response = (new ResponseData())->setStatus(true)
                ->setMessage('Thêm thành công!')
                ->setData($room)
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
     * @OA\Get(
     *   path="/user/rooms/{roomId}",
     *   operationId="rooms.show",
     *   tags={"[Quản lý phòng] API liên quan đến phòng"},
     *   summary="Chi tiết phòng",
     *   description="Sửa phòng",
     *   security={{"sanctum": {}}},
     *   @OA\Parameter(
     *      name="roomId",
     *      in="path",
     *      description="Nhập id của phòng",
     *      required=true,
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation"
     *   )
     * )
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = $this->roomService->find($id);

        return new RoomResource($room);
    }

    /**
     * @OA\Post(
     *   path="/user/rooms/{roomId}",
     *   operationId="rooms.update",
     *   tags={"[Quản lý phòng] API liên quan đến phòng"},
     *   summary="Sửa phòng",
     *   description="Sửa phòng",
     *   security={{"sanctum": {}}},
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *          ref="#/components/schemas/UpdateRoomRequest"
     *       )
     *   ),
     *   @OA\Parameter(
     *      name="roomId",
     *      in="path",
     *      description="Nhập id của phòng",
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

    public function update(UpdateRoomRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $room = $this->roomService->update($data, $id);
            DB::commit();
            $response = (new ResponseData())->setStatus(true)
                ->setMessage('Sửa thành công!')
                ->setData($room)
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
     *   path="/user/rooms/{roomId}",
     *   operationId="rooms.destroy",
     *   tags={"[Quản lý phòng] API liên quan đến phòng"},
     *   summary="Xóa phòng",
     *   description="Xóa phòng",
     *   security={{"sanctum": {}}},
     *   @OA\Parameter(
     *      name="roomId",
     *      in="path",
     *      description="Nhập id của phòng",
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

            $room = $this->roomService->delete($id);
            DB::commit();
            $response = (new ResponseData())->setStatus(true)
                ->setMessage('Xóa thành công!')
                ->setData(['affected' => $room])
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

    /**
     * @OA\Get(
     *     path="/user/rooms/house/{houseId}",
     *     operationId="rooms.getRoomByHouse",
     *     summary="Danh sách phòng theo nhà",
     *     description="Danh sách phòng theo nhà",
     *     tags={"[Quản lý phòng] API liên quan đến phòng"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *      name="houseId",
     *      in="path",
     *      description="Nhập id của nhà",
     *      required=true,
     *    ),
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
    public function getRoomByHouse($houseId)
    {
        $rooms = $this->roomService->findWhere(['house_id' => $houseId], ['*']);

        return new RoomCollection($rooms);
    }
}
