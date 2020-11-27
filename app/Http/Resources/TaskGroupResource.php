<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskGroupResource extends JsonResource
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
            'tasks' => TaskResource::collection($this->whenLoaded('tasks')),
            'schedule' => $this->schedule->format('m-d-Y'),
            'completed' => $this->isCompleted(),
            'createdAt' => $this->created_at->toDateTimeString(),
        ];
    }
}
