@extends('layouts.app')

@section('content')
<h2 class="display-6 text-center mb-4">Tareas</h2>

<a href="/tasks/create" class="btn btn-outline-primary">Nueva Tarea</a>
<div class="table-responsive">
    <table class="table text-left">
        <thead>
            <tr>
                <th style="width: 5%">ID</th>
                <th style="width: 22%;">Nombre</th>
                <th style="width: 22%;">Prioridad</th>
                <th style="width: 22%;">Completada</th>
                <th style="width: 22%;">Usuario</th>
                <th style="width: 22%;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <th scope="row" class="text-start">{{ $task->id }}</th>
                <th scope="row" class="text-start">
                    <a href="/tasks/{{ $task->id }}">{{ $task->name }}</a>
                </th>
                <td>
                    <span class="badge text-bg-warning">{{ ucfirst($task->priority) }}</span>
                </td>
                <td>
                    {{ $task->completed ? 'Sí' : 'No' }}
                </td>
                <td>
                    {{ $task->user ? $task->user->name : 'Sin usuario asignado' }}
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
