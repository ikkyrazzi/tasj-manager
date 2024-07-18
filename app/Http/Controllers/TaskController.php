<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Notifications\TaskCreated;
use App\Notifications\TaskUpdated;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::all();
        $users = User::all(); // Menambahkan pengambilan semua pengguna untuk dropdown
        return view('tasks.create', compact('projects', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'project_id' => 'required|exists:projects,id', // Memastikan project_id valid
            'user_id' => 'required|exists:users,id', // Memastikan user_id valid
            'status' => 'required|in:pending,in_progress,completed', // Memastikan status valid
            'due_date' => 'nullable|date' // Memastikan due_date dalam format tanggal yang benar
        ]);

        $task = Task::create($request->all());

        $task->user->notify(new TaskCreated($task));

        return redirect()->route('tasks.index')
                        ->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        $users = User::all(); // Menambahkan pengambilan semua pengguna untuk dropdown
        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'project_id' => 'required|exists:projects,id', // Memastikan project_id valid
            'user_id' => 'required|exists:users,id', // Memastikan user_id valid
            'status' => 'required|in:pending,in_progress,completed', // Memastikan status valid
            'due_date' => 'nullable|date' // Memastikan due_date dalam format tanggal yang benar
        ]);

        $task->update($request->all());

        $task->user->notify(new TaskUpdated($task));

        return redirect()->route('tasks.index')
                        ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully.');
    }
}
