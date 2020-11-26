<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Http\Resources\TaskListResource;

class GetTaskList extends Controller
{
    public function __invoke(string $date)
    {
        $tasks = TaskList::query()
            ->with('tasks')
            ->whereScheduledOn($date)
            ->get();

        return TaskListResource::collection($tasks);
    }
}
