<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskPriorityRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('project_id')) {
            $tasks = Task::with('project')->where('project_id', $request->project_id)->orderBy('priority')->get();
            $projects = Project::all();
        } else {
            $tasks = Task::with('project')->orderBy('priority')->get();
            $projects = Project::all();
        }


        return view('tasks.index', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();

        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $maxPriority = Task::max('priority') ?: 0;
        $newTaskPriority = $maxPriority + 1;

        if ($request->has('priority_position')) {
            if ($request->priority_position == 'top') {
                Task::query()->update(['priority' => DB::raw('priority + 1')]);
                $newTaskPriority = 1;
            }
        }

        Task::create($request->validated() + ['priority' => $newTaskPriority]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $projects = Project::all();

        return view('tasks.edit', compact('projects', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $makePriority1 = false;
        if ($request->has('priority_position')) {
            if ($request->priority_position == 'top') {
                Task::query()->update(['priority' => DB::raw('priority + 1')]);
                $makePriority1 = true;
            } else {
                (new TaskService())->updatePriority($task, Task::orderBy('priority', 'DESC')->first());
            }
        }
        if ($makePriority1) {
            $task->update($request->validated() + ['priority' => 1]);
        } else {
            $task->update($request->validated());
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function updatePriority(UpdateTaskPriorityRequest $request, Task $task)
    {
        $prevTask = Task::find($request->prev_task_id);

        (new TaskService())->updatePriority($task, $prevTask);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Task::where('priority', '>', $task->priority)
            ->update(['priority' => DB::raw('priority - 1')]);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
