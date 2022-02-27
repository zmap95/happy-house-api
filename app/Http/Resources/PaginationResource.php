<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'current_page' => $this->resource->currentPage(),
            'per_page' => intval($this->resource->perPage()),
            'total_pages' => ceil($this->resource->total() / $this->resource->perPage()),
        ];
    }
}
