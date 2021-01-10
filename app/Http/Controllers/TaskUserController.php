<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class TaskUserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * Check form and save it in db
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Task $task)
    {
        $validatedData = $request->validate
        ([
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $taskUser = new TaskUser();
        $taskUser->user_id = $validatedData['user_id'];
        $taskUser->task_id = $task->id;
        $taskUser->save();

        return redirect()->route('tasks.show', $task);

    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @param int $id
     * @return Response
     */
    public function destroy(TaskUser $taskUser, Task $task)
    {
        $taskUser->delete();
        return redirect()->route('tasks.show', $task);
    }
}
