<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHouseRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
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
            'common_fee' => 'required',
            'electricity_per_kwh' => 'nullable',
            'water_per_block' => 'nullable',
            'electricity_closing_date' => 'nullable',
            'water_closing_date' => 'nullable',
            'public_community_status' => 'nullable',
            'status' => 'required',
            'description' => 'nullable',
            'utilities' => 'nullable',
            'utilities.*.icon' => 'required',
            'utilities.*.name' => 'required',
            'rules' => 'nullable',
            'rules.*.icon' => 'required',
            'rules.*.name' => 'required',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'images' => 'nullable|array',
        ];
    }
}
