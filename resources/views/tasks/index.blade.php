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
                    <a href="/tasks/{{ $task->id}}">{{ $task->name }}</a>
                </th>
                <td>
                    <span class="badge text-bg-warning">{{ $task->priority?->name }}</span>
                </td>
                <td>
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="#check" />
                    </svg>
                </td>
                <td>
                    {{ $task->user ? $task->user->name : 'Sin usuario asignado' }}
                </td>
                <td>
                    <a href="#" class="btn btn-primary">Completar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
