<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHouseRequest extends FormRequest
{
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
     *   @OA\Schema(
     *      title="[Quản lý nhà] API liên quan đến nhà",
     *      type="object",
     *      schema="UpdateHouseRequest",
     *      description="Sửa thông tin nhà",
     *      required={
     *          "name", "category_id", "address", "type_id", "province_id", "district_id",
     *          "commune_id", "commune_id", "common_fee", "water_closing_date",
     *          "electricity_closing_date", "status"
     *      },
     *          @OA\Property(
     *              property="name",
     *              description="Tên nhà",
     *              example="House NIC 888",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="category_id",
     *              description="Chọn loại nhà",
     *              example=1,
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="address",
     *              description="Địa chỉ",
     *              example="Ngõ 7, Tôn Thất thuyết",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="type_id",
     *              description="Hình thức cho thuê",
     *              example=1,
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="province_id",
     *              description="Tỉnh/Thành phố",
     *              example=30,
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="district_id",
     *              description="Quận/huyện",
     *              example=318,
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="commune_id",
     *              description="Xã/phường/Thị trấn",
     *              example=5630,
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="common_fee",
     *              description="Phí chung: Nguyên căn/riêng từng phòng(separate/all_room)",
     *              example="all_room",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="electricity_per_kwh",
     *              description="Tiền điện trên 1 kwH",
     *              example=40000,
     *              type="number",
     *              format="double"
     *          ),
     *          @OA\Property(
     *              property="water_per_block",
     *              description="Tiền nước trên 1 khối",
     *              example=1,
     *              type="number",
     *              format="double"
     *          ),
     *          @OA\Property(
     *              property="water_closing_date",
     *              description="Ngày ghi chỉ số nước",
     *              example=1,
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="electricity_closing_date",
     *              description="Ngày ghi chỉ số điện",
     *              example=1,
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="description",
     *              description="Mô tả nhà",
     *              example="Theo sự phát triển của xã hội Việt Nam, nhu cầu nhà ở đang tăng nhanh một cách chóng mặt.",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="status",
     *              description="Trạng thái active/inactive",
     *              example="active",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="utilities",
     *              description="Tiện ích phòng",
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Tên tiện ích",
     *                      example="Đồng hồ treo tường"
     *                  ),
     *                  @OA\Property(
     *                      property="icon",
     *                      type="string",
     *                      description="icon tiện ích",
     *                      example="fa-alarm-clock"
     *                  ),
     *              ),
     *          ),
     *          @OA\Property(
     *              property="rules",
     *              description="Nội quy phòng",
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Tên Nội quy",
     *                      example="Về trước 23h"
     *                  ),
     *                  @OA\Property(
     *                      property="icon",
     *                      type="string",
     *                      description="Icon Nội quy",
     *                      example="fa-alarm-exclamation"
     *                  ),
     *              ),
     *          ),
     *   )
     */



    public function rules()
    {
        return [
            'house_id' => 'bail|required|integer',
            'name' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'commune_id' => 'required',
            'common_fee' => 'in:'.config('constant.house.common_fee.all_room').','
                .config('constant.house.common_fee.separate'),
            'electricity_per_kwh' => 'nullable',
            'water_per_block' => 'nullable',
            'electricity_closing_date' => 'nullable',
            'water_closing_date' => 'nullable',
            'public_community_status' => 'nullable',
            'status' => 'in:'.config('constant.status.active').','
                .config('constant.status.inactive'),
            'description' => 'nullable',
            'utilities' => 'sometimes|array',
            'rules' => 'sometimes|array',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'pictures' => 'nullable|array',
        ];
    }
}
