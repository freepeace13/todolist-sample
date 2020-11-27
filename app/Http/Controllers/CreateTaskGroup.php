<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use Illuminate\Http\Request;
use App\Http\Resources\TaskGroupResource;

class CreateTaskGroup extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param string $date
     * @return void
     */
    public function __invoke(string $date)
    {
        $tasklist = TaskGroup::create(['schedule' => $date]);

        return (new TaskGroupResource(
            $tasklist->load('tasks')
        ));
    }
}
