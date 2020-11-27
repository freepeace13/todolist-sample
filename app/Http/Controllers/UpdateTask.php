<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;

class UpdateTask extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $groupId
     * @param integer $taskId
     *
     * @return void
     */
    public function __invoke(Request $request, int $groupId, int $taskId)
    {
        $inputs = $this->validate($request, [
            'title' => ['nullable', 'string'],
            'completed' => ['boolean'],
        ]);

        $task = Task::find($taskId);

        $task->forceFill($inputs)->save();

        return new TaskResource($task);
    }
}
