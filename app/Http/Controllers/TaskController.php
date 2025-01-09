<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function dashboard()
    {
        $user = User::find(request()->user()->id);
        $userGroups = $user->taskGroups()->get();
        $incompleteTasks = $user->incompleteTasks()->orderBy('created_at', 'desc')->get();
        $completedTasks = $user->completedTasks()->orderBy('completed_at', 'desc')->get();

        return view('dashboard', [ 'allTasks' => $incompleteTasks, 'groups' => $userGroups, 'completedTasks' => $completedTasks]);
    }

    public function complete(Request $request, Task $task)
    {
        $result = $task->update(['completed_at' => Carbon::now()]);

        return view('task.partials.completed-task', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->task_group_id === 'null')
            $request->merge([
                'task_group_id' => null
            ]);

        $data = $request->validateWithBag('taskErrors', [
            'task' => 'string|present',
            'deadline' => 'date|after_or_equal:now|nullable',
            'task_group_id' => ['nullable', Rule::exists('task_groups', 'id')->where('user_id', request()->user()->id),]
        ]);

        $data['user_id'] = request()->user()->id;

        Task::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
