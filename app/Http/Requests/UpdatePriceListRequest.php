<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="Price list request",
 *     type="object",
 *     schema="UpdatePriceListRequest",
 *     description="request body data",
 *     required={"name", "fee_category_id", "unit_price"}
 * )
 */
class UpdatePriceListRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     title="_method",
     *     description="tên của phòng",
     *     default="PUT"
     * )
     * @var string
     */
    private $_method;

    /**
     * @OA\Property(
     *     title="name",
     *     description="tên chi phí (điện, nước, v.v)",
     *     example="Tiền điện"
     * )
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="fee_category_id",
     *     description="ID danh mục phí",
     *     example="1"
     * )
     * @var string
     */
    private $fee_category_id;

    /**
     * @OA\Property(
     *     title="unit_price",
     *     description="Đợn Giá chi phí",
     *     example="4000"
     * )
     * @var string
     */
    private $unit_price;

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
            'name' => 'required',
            'fee_category_id' => 'required',
            'unit_price' => 'required:numeric'
        ];
    }
}
