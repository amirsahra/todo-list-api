<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::paginate(config('todosettings.paginate.task'));
        return response()->apiResult(
            __('messages.method.index', ['name' => __('values.tasks')]), [
            'tasks' => TaskResource::collection($tasks),
            'links' => TaskResource::collection($tasks)->response()->getData()->links,
            'meta' => TaskResource::collection($tasks)->response()->getData()->meta,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show(Task $task)
    {
        return response()->apiResult(
            __('messages.method.show', ['name' => __('values.task')]),
            new TaskResource($task)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Task $task)
    {
        $task->delete();
        return response()->apiResult(
            __('messages.method.destroy', ['name' => __('values.task')]),
        );
    }
}
