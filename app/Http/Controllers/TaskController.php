<?php

namespace App\Http\Controllers;
use App\Models\User; // Importa el modelo User
use App\Models\Tag; // Importa el modelo Tag
use App\Models\Task; // Importa el modelo Task
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $users = User::all(); // Obtén todos los usuarios disponibles
    
        return view('tasks.create', compact('tags', 'users'));
    }
    
    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task
        ]);
    }
    

   
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'priority' => 'required|string|max:50',
        'tags' => 'array', // Validar etiquetas si es necesario
    ]);

    $task = new Task();
    $task->name = $request->input('name');
    $task->description = $request->input('description');
    $task->priority = $request->input('priority');
    $task->completed = $request->has('completed');
    $task->user_id = Auth::id(); // Asignar el usuario logueado

    $task->save();

    // Sincronizar etiquetas
    $task->tags()->sync($request->input('tags', []));

    return redirect()->route('tasks.index')->with('success', 'Tarea creada exitosamente');
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
    // No modificar user_id ya que es el usuario logueado que creó la tarea

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
