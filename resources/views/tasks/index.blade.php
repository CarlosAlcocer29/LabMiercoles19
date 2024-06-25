<!-- resources/views/tasks/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Lista de Tareas</h1>
                    </div>
                    <div class="card-body">
                        <div class="text-right mb-3">
                            <a href="/tasks/create" class="btn btn-success">Crear Tarea</a>
                        </div>
                        <ul class="list-group">
                            @foreach ($tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="/tasks/{{ $task->id }}">{{ $task->name }}</a> 
                                    <form action="/tasks/{{ $task->id }}/complete" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-primary">Completar</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
