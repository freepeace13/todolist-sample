<?php

namespace App\Http\Controllers;

use App\Models\Task;

class DeleteTask extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param integer $groupId
     * @param integer $taskId
     *
     * @return void
     */
    public function __invoke(int $groupId, int $taskId)
    {
        $task = Task::find($taskId);

        $task->delete();

        return response()->json([], 200);
    }
}
