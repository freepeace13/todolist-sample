<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use App\Http\Resources\TaskResource;

class CreateTask extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param integer $groupId
     * @return void
     */
    public function __invoke(int $groupId)
    {
        $group = TaskGroup::find($groupId);

        $task = $group->tasks()->create([
            'completed' => false
        ]);

        return new TaskResource($task);
    }
}
