<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'province' => $this->province,
            'district' => $this->district,
            'commune' => $this->commune,
            'category' => $this->category,
            'type' => $this->type,
            'common_fee' => $this->common_fee,
            'electricity_per_kwh' => $this->electricity_per_kwh,
            'water_per_block' => $this->water_per_block,
            'electricity_closing_date' => $this->electricity_closing_date,
            'water_closing_date' => $this->water_closing_date,
            'public_community_status' => $this->public_community_status,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}
