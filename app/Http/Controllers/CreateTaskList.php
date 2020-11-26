<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Http\Resources\TaskListResource;

class CreateTaskList extends Controller
{
    public function __invoke(string $date)
    {
        $tasklist = TaskList::create(['schedule' => $date]);

        return (new TaskListResource(
            $tasklist->load('tasks')
        ));
    }
}
