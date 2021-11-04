<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:checkUser,task')->only([
            'updateDone', 'update', 'destroy'
        ]);
    }

    /**
     * 
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        // abort(500); // エラー表示される
        // return []; // 登録数が0の場合
        return Task::where('user_id', Auth::id())->orderByDesc('id')->get();
    }

    /**
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaskRequest $request)
    {
        $request->merge([
            'user_id' => Auth::id()
        ]);

        $task = Task::create($request->all());

        return $task
            ? response()->json($task, 201)
            : response()->json([], 500);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param TaskRequest $request
     * @param \Illuminate\Http\Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->title = $request->title;

        return $task->update()
            ? response()->json($task)
            : response()->json([], 500);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        return $task->delete()
            ? response()->json($task)
            : response()->json([], 500);
    }

    /**
     * is_doneの更新
     * 
     * @param Task $task
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDone(Request $request, Task $task)
    {
        // abort(500);

        $task->is_done = $request->is_done;

        return $task->update()
            ? response()->json($task)
            : response()->json([], 500);
    }
}
