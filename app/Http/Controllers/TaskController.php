<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Auth::user()->tasks()->paginate(5);
        // echo ($tasks);
        return view('tasks.index', compact('tasks'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(CreateTaskRequest $request)
    {
        $task = new Task;
        $task->user_id = Auth::user()->id;
        $task->content  = $request->content;
        $task->status   = "In-progress";
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task = Task::find($request->hidden_id);
        $task->content  = $request->content;
        $task->status   = $request->status;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task has been updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}