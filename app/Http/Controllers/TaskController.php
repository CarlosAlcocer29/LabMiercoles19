<?php

namespace App\Http\Controllers;
use App\Models\Tag; 
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
  
    public function index()
    {
        $tasks = Task::with('user', 'tags')->get(); // Cargar tareas con usuario y etiquetas
    
        return view('tasks.index', compact('tasks'));
    }
    

    

public function create()
{
    $tags = Tag::all(); // Obtén todas las etiquetas disponibles

    return view('tasks.create', compact('tags'));
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

    
public function edit($id)
{
    $task = Task::findOrFail($id);
    $tags = Tag::all(); // Obtén todas las etiquetas disponibles

    return view('tasks.edit', compact('task', 'tags'));
}


public function update(Request $request, $id)
{
    $task = Task::findOrFail($id);
    $task->name = $request->input('name');
    $task->description = $request->input('description');
    $task->priority = $request->input('priority');
    $task->completed = $request->has('completed');
    $task->save();

    // Sincronizar etiquetas
    $task->tags()->sync($request->input('tags', []));

    return redirect()->route('tasks.index')->with('success', 'Tarea actualizada exitosamente');
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
