<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
  
  public function index()
{
    $tasks = Task::with('user')->get();
    return view('tasks.index', compact('tasks'));
}

    

    public function create()
    {
        return view('tasks.create');
    }

    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function store()
{
    $data = request()->validate([
        'name' => ['required', 'min:3', 'max:255'],
        'description' => ['required', 'min:3'],
        'priority' => ['required', 'in:baja,media,alta'],
        'completed' => ['boolean'],
    ]);

    Task::create($data);

    return redirect('/tasks');
}

    
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    public function update(Task $task)
    {
        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'priority' => ['required', 'in:baja,media,alta'],
            'completed' => ['boolean'],
        ]);
    
        $task->fill($data)->save();
    
        return redirect('/tasks/' . $task->id);
    }
    
    
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks');
    }
    public function complete(Task $task)
    {
        $task->completed = 1;
        $task->save();

        return redirect('/tasks');
    }
}
