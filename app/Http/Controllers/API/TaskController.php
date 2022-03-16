<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use App\Models\UserTasks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        $userTaskIds = UserTasks::where('user_id', $userId)->pluck('task_id');
        $userTasks = Task::whereIn('id', $userTaskIds)->get();

        return response()->json($userTasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $task = new Task();
        $task->task_name = $request->taskName;

        if($task->save()) {
            $userTask = new UserTasks();
            $userTask->user_id = $request->userId;
            $userTask->task_id = $task->id;
            $userTask->save();

            return response()->json(['success' => true, 'message' => 'Task added successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $taskId
     * @return \Illuminate\Http\Response
     */
    public function edit($taskId)
    {   
        $task = Task::find($taskId);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        Task::where('id', $request->id)->update(['task_name' => $request->task_name]);
        return response()->json(['success' => true, 'message' => 'Task updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }
}
