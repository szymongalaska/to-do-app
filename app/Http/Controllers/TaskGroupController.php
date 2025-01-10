<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use App\Models\User;
use Illuminate\Http\Request;

class TaskGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $taskGroups = User::find(request()->user()->id)->taskGroups()->get();

        if(request()->query('group'))
            $group = $taskGroups->find(request()->query('group'));

        return view('task_group.index', ['groups' => $taskGroups, 'selectedGroup' => $group ?? null]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task_group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validateWithBag('taskGroupErrors', [
            'name' => 'string|required',
            'color' => 'hex_color|max:9',
            'icon' => 'string|max:25'
        ]);

        $data['user_id'] = request()->user()->id;

        TaskGroup::create($data);

        return to_route('task-group.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($taskGroup)
    {   
        $user = User::find(request()->user()->id);

        if($taskGroup === 'all')
            $group = view('task_group.all', ['tasks' => $user->tasks()->get()]);
        else if($taskGroup === 'completed')
            $group = view('task_group.completed',['tasks' => $user->completedTasks()->get()]);
        else
            $group = view('task_group.partials.group',['group' => $user->taskGroups()->find($taskGroup), 'sortOrders' => TaskGroup::ORDERS]);


        if(request()->ajax())
            return $group;
        else
            return view('task_group.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskGroup $taskGroup)
    {
        return view('task_group.edit', ['group' => $taskGroup]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskGroup $taskGroup)
    {
        $data = $request->validateWithBag('taskGroupErrors', [
            'name' => 'string|required',
            'color' => 'hex_color|max:9',
            'icon' => 'string|max:25'
        ]);

        $taskGroup->update($data);

        return to_route('tasks');
    }

    public function updateOrder(Request $request, TaskGroup $taskGroup)
    {
        $data = $request->validate([
            'order' => 'required|in:'.implode(',', TaskGroup::ORDERS),
        ]);

        $taskGroup->update($data);
        return response()->view('task_group.partials.group', ['group' => $taskGroup, 'sortOrders' => TaskGroup::ORDERS]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskGroup $taskGroup)
    {
        //
    }
}
