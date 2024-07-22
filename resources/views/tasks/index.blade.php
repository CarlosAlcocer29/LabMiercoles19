@extends('layouts.app')

@section('content')
    <h2 class="display-6 text-center mb-4">Lista de Tareas</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Prioridad</th>
                <th>Completada</th>
                <th>Usuario</th>
                <th>Etiquetas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->completed ? 'Sí' : 'No' }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>
                        @foreach ($task->tags as $tag)
                            {{ $tag->name }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Crear Tarea</a>
@endsection
