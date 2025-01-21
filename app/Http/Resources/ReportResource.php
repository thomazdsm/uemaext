<?php

namespace App\Http\Resources;

use App\Filament\Resources\StatusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'project_id' => $this->project_id,
            'description' => $this->description,
            'status_id' => $this->status_id,
            'project' => new ProjectResource($this->whenLoaded('project')),
            'status' => [
                'id' => $this->status->id,
                'name' => $this->status->name,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
