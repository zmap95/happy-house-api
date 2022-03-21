<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'empty_room_day' => $this->empty_room_day,
            'house_id' => $this->house_id,
            'room_name' => $this->room_name,
            'floor' => $this->floor,
            'price' => $this->price,
            'acreage' => $this->acreage,
            'amount_of_people' => $this->amount_of_people,
            'deposit' => $this->deposit,
            'amenities' => $this->amenities,
            'newAmenities' => $this->newAmenities,
            'room_pictures' => $this->room_pictures,
            'status' => $this->status
        ];
    }
}
