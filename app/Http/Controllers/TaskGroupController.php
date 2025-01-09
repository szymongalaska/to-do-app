<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use Illuminate\Http\Request;

class TaskGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(TaskGroup $taskGroup)
    {
        //
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

        return to_route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskGroup $taskGroup)
    {
        //
    }
}
