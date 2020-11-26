<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Resources\TaskListResource;

class UpdateTaskList extends Controller
{
    public function __invoke(Request $request, $listId)
    {
        $validated = $this->validate($request, [
            'title' => ['nullable', 'string'],
            'tasks' => ['array'],
            'tasks.*' => ['array'],
            'tasks.*.id' => ['required', 'exists:tasks,id'],
            'tasks.*.title' => ['nullable', 'string'],
            'tasks.*.completed' => ['boolean']
        ]);

        $tasklist = TaskList::find($listId);

        $tasklist->forceFill([
            'title' => $validated['title']
        ])->save();

        foreach ($validated['tasks'] as $taskInput) {
            $task = $tasklist->tasks()->find($taskInput['id']);

            if (! is_null($task)) {
                $task->forceFill(
                    Arr::only($taskInput, ['title', 'completed'])
                )->save();
            }
        }

        return (new TaskListResource(
            $tasklist->fresh()->load('tasks')
        ));
    }
}
