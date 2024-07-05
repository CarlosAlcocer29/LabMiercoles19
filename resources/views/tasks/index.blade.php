@extends('layouts.app')

@section('content')
    <h2 class="display-6 text-center mb-4">Lista de Tareas</h2>

    <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary mb-3">Nueva Tarea</a>
    <div class="table-responsive">
        <table class="table text-left">
            <thead>
                <tr>
                    <th style="width: 5%">ID</th>
                    <th style="width: 22%;">Nombre</th>
                    <th style="width: 22%;">Prioridad</th>
                    <th style="width: 22%;">Completada</th>
                    <th style="width: 22%;">Usuario</th>
                    <th style="width: 22%;">Etiquetas</th>
                    <th style="width: 22%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td class="text-start">{{ $task->id }}</td>
                    <td class="text-start">
                        <a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a>
                    </td>
                    <td>
                        <span class="badge bg-warning text-dark">{{ ucfirst($task->priority) }}</span>
                    </td>
                    <td>
                        {{ $task->completed ? 'Sí' : 'No' }}
                    </td>
                    <td>
                        {{ $task->user ? $task->user->name : 'Sin usuario asignado' }}
                    </td>
                    <td>
                        @foreach($task->tags as $tag)
                            <span class="badge bg-primary">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if(!$task->completed)
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">Completar</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
