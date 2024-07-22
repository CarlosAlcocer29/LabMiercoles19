<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use App\Models\Tag;

class TaskController extends Controller
{
    public function index()
{
    $tasks = Task::where('user_id', Auth::id())->get();
    return view('tasks.index', compact('tasks'));
}


    public function create()
    {
        $users = User::all();
        $tags = Tag::all();
        return view('tasks.create', compact('users', 'tags'));
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|string|max:50',
            'user_id' => 'nullable|exists:users,id', // Validar que el user_id exista en la tabla users
            // Agrega más validaciones según tus necesidades
        ]);

        // Crear una nueva instancia de Task y asignar valores
        $task = new Task();
        $task->name = $request->input('name');
        $task->priority = $request->input('priority');
        $task->completed = $request->has('completed'); // Cambiado para capturar el estado del checkbox
        $task->user_id = $request->input('user_id'); // Asignar el usuario

        // Guardar la tarea en la base de datos
        $task->save();

        // Sincronizar etiquetas
        $task->tags()->sync($request->input('tags', []));

        // Redireccionar a la vista deseada o retornar una respuesta según tu lógica
        return redirect()->route('tasks.index')->with('success', 'Tarea creada exitosamente');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        // Verificar si el usuario puede editar esta tarea
        $this->authorize('update', $task);

        $users = User::all();
        $tags = Tag::all();
        return view('tasks.edit', compact('task', 'users', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // Verificar si el usuario puede actualizar esta tarea
        $this->authorize('update', $task);

        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->priority = $request->input('priority');
        $task->completed = $request->has('completed');
        $task->save();

        // Sincronizar etiquetas
        $task->tags()->sync($request->input('tags', []));

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada exitosamente');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        // Verificar si el usuario puede eliminar esta tarea
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente');
    }
}
