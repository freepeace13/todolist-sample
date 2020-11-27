<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use App\Http\Resources\TaskGroupResource;

class DeleteTaskGroup extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param integer $id
     * @return void
     */
    public function __invoke(int $id)
    {
        $group = TaskGroup::find($id);
        $group->tasks()->delete();
        $group->delete();

        return response()->json([], 200);
    }
}
