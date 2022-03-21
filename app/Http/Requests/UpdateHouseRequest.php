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
     *      title="House request",
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
     *              property="delete_pictures",
     *              description="Các hình ảnh của nhà bị xóa",
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="id",
     *                      type="integer",
     *                      description="ID ảnh của nhà",
     *                      example="1",
     *                  ),
     *                  @OA\Property(
     *                      property="path",
     *                      type="string",
     *                      description="path ảnh của nhà",
     *                      example="/temporary/2022/03/18/bD8620sFoY2X1647573060phpFD16.tmp.png",
     *                  ),
     *              ),
     *          ),
     *          @OA\Property(
     *              property="pictures",
     *              description="Thêm hình ảnh của nhà",
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="path",
     *                      type="string",
     *                      example="/temporary/2022/03/18/bD8620sFoY2X1647573060phpFD16.tmp.png",
     *                  ),
     *              ),
     *          ),
     *          @OA\Property(
     *              property="edit_utilities",
     *              description="Danh sách Tiện ích phòng chỉnh sửa/xóa",
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="id",
     *                      type="integer",
     *                      description="id tiện ích",
     *                      example=1
     *                  ),
     *                  @OA\Property(
     *                      property="delete",
     *                      type="integer",
     *                      description="Trạngthasi có phải id bị xóa hay không. 0:chỉnh sửa, 1:xóa",
     *                      example=1
     *                  ),
     *                  @OA\Property(
     *                      property="checked",
     *                      type="integer",
     *                      description="Trạng thái checked. 0: not checked / 1:checked",
     *                      example=1
     *                  ),
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
     *              property="utilities",
     *              description="Tiện ích nhà",
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Tên tiện ích",
     *                      example="Đồng hồ treo cầu thang"
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
     *              property="edit_rules",
     *              description="Nội quy nhà chỉnh sửa/xóa",
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="id",
     *                      type="integer",
     *                      description="id Nội quy nhà",
     *                      example=1
     *                  ),
     *                  @OA\Property(
     *                      property="delete",
     *                      type="integer",
     *                      description="Trạng thái có phải id bị xóa hay không. 0:chỉnh sửa, 1:xóa",
     *                      example=1
     *                  ),
     *                  @OA\Property(
     *                      property="checked",
     *                      type="integer",
     *                      description="Trạng thái checked. 0: not checked / 1:checked",
     *                      example=1
     *                  ),
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Tên Nội quy",
     *                      example="Về trước 24h"
     *                  ),
     *                  @OA\Property(
     *                      property="icon",
     *                      type="string",
     *                      description="Icon Nội quy",
     *                      example="fa-alarm-exclamation"
     *                  ),
     *              ),
     *          ),
     *          @OA\Property(
     *              property="rules",
     *              description="Nội quy nhà được thêm mới",
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
            'pictures' => 'sometimes|array',
            'delete_pictures' => 'sometimes|array',
            'edit_utilities' => 'sometimes|array',
            'edit_rules' => 'sometimes|array'
        ];
    }
}
