<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param mixed $request
     * @return void
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'groupId' => $this->group_id,
            'completed' => $this->completed,
            'createdAt' => $this->created_at->toDateTimeString()
        ];
    }
}
