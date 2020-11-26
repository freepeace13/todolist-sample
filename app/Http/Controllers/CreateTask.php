<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;

class CreateTask extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $this->validate($request, [
            'listId' => ['required', 'exists:task_lists,id'],
        ]);

        $tasklist = TaskList::find($validated['listId']);

        $task = $tasklist->tasks()->create([
            'completed' => false
        ]);

        return new TaskResource($task);
    }
}
