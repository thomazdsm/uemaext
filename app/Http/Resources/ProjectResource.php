<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'department' => [
                'id' => $this->department->id,
                'name' => $this->department->name,
            ],
            'status' => [
                'id' => $this->status->id,
                'name' => $this->status->name,
            ],
            'type' => [
                'id' => $this->type->id,
                'name' => $this->type->name,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
