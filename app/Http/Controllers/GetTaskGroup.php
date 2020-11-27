<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use App\Http\Resources\TaskGroupResource;

class GetTaskGroup extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param string $date
     * @return void
     */
    public function __invoke(string $date)
    {
        return TaskGroupResource::collection(
            TaskGroup::with('tasks')->dated($date)->get()
        );
    }
}
