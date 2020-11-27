<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Resources\TaskGroupResource;

class UpdateTaskGroup extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     *
     * @return void
     */
    public function __invoke(Request $request, int $id)
    {
        $group = TaskGroup::find($id);

        $group->forceFill([
            'title' => $request->input('title', null)
        ])->save();

        return (new TaskGroupResource(
            $group->fresh()->load('tasks')
        ));
    }
}
