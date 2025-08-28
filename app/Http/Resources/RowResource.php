<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'table_id' => $this->table_id,
            'data' => $this->data,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
