<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'entity_type' => $this->entity_type,
            'entity_id' => $this->entity_id,
            'path' => $this->path,
            'original_name' => $this->original_name,
            'mime' => $this->mime,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
