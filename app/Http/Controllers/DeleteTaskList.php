<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Http\Resources\TaskListResource;

class DeleteTaskList extends Controller
{
    public function __invoke($listId)
    {
        $tasklist = TaskList::find($listId);
        $tasklist->tasks()->delete();
        $tasklist->delete();

        return response()->json([], 200);
    }
}
