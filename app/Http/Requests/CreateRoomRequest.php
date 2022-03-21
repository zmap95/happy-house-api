<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *   @OA\Schema(
 *      title="RoomCollection request",
 *      type="object",
 *      description="RoomCollection request body data",
 *      required={"empty_room_day", "house_id", "room_name", "floor", "price", "acreage", "amount_of_people", "deposit"}
 *   )
 */
class CreateRoomRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     title="empty_room_day",
     *     description="Ngày phòng trống",
     *     example="2014-02-26"
     * )
     * @var integer
     */
    private $empty_room_day;

    /**
     * @OA\Property(
     *     title="house_id",
     *     description="tên của phòng",
     *     example="1"
     * )
     * @var integer
     */
    private $house_id;

    /**
     * @OA\Property(
     *     title="room_name",
     *     description="tên của phòng",
     *     example="Số phòng 1"
     * )
     * @var string
     */
    private $room_name;

    /**
     * @OA\Property(
     *     title="floor",
     *     description="tầng, khu, dãy của nhà",
     *     example="Tầng 2"
     * )
     * @var string
     */
    private $floor;

    /**
     * @OA\Property(
     *     title="price",
     *     description="giá của phòng",
     *     example=2000000
     * )
     * @var double
     */
    private $price;

    /**
     * @OA\Property(
     *     title="acreage",
     *     description="diện tích của phòng (m2)",
     *     example=15
     * )
     * @var float
     */
    private $acreage;

    /**
     * @OA\Property(
     *     title="amount_of_people",
     *     description="số người trên phòng",
     *     example=2
     * )
     * @var integer
     */
    private $amount_of_people;

    /**
     * @OA\Property(
     *     title="deposit",
     *     description="tiền đặt cọc phòng",
     *     example=500000
     * )
     * @var double
     */
    private $deposit;

    /**
     * @OA\Property(
     *     property="amenities",
     *     description="Các tiện ích của phòng(có thẻ để trống)",
     *     @OA\Items(
     *        @OA\Property(
     *              property="name",
     *              type="string",
     *              description="Tên tiện ích",
     *              example="tủ lạnh"
     *        ),
     *        @OA\Property(
     *              property="icon",
     *              type="string",
     *              description="icon tiện ích",
     *              example="class (fontawesome)"
     *        ),
     *
     *     ),
     * )
     * @var array
     */
    private $amenities;

    /**
     * @OA\Property(
     *     property="newAmenities",
     *     type="array",
     *     description="thêm các tiện ích của phòng nếu nó chưa nằm trong danh sách chọn (có thể null)",
     *     @OA\Items(
     *        @OA\Property(
     *              property="name",
     *              type="string",
     *              description="Tên tiện ích",
     *              example="tủ lạnh"
     *        ),
     *        @OA\Property(
     *              property="icon",
     *              type="string",
     *              description="icon tiện ích",
     *              example="class (fontawesome)"
     *        ),
     *
     *     ),
     *
     *
     *
     * )
     * @var array
     */
    private $newAmenities;

    /**
     * @OA\Property(
     *     property="room_pictures",
     *     type="array",
     *     description="thêm hình ảnh các vị trí trong phòng (có thể null)",
     *     @OA\Items(
     *          type="string"
     *     ),
     *     example={"{$path} Hãy cho tôi file"}
     *
     *
     *
     * )
     * @var array
     */
    private $room_pictures;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'empty_room_day' => 'bail|required|date',
            'house_id' => 'bail|required|integer',
            'room_name' => 'bail|required',
            'floor' => 'bail|required',
            'price' => 'bail:required:numeric',
            'acreage' => 'bail:required:numeric',
            'amount_of_people' => 'bail|required:integer',
            'deposit' => 'bail:required:numeric',
            'amenities' => 'sometimes|array',
            'newAmenities' => 'sometimes|array',
            'room_pictures' => 'sometimes|array'
        ];
    }
}
